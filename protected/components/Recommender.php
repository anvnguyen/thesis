<?php

class Recommender
{	
	/* List of behaviour models from table behaviour */
	public $behaviours;
	
	/* List of user in behaviour table */
	public $listUsers;
	
	/* List of items in behaviour table */
	public $listItems;
	
	public $listItemCategory;
	
	// public $listUsersItems;
	
	/* List of user means base on $listUsers and their behaviours */
	public $userMean;

	/*List of user and items which this user evaluate*/
	public $userItems;
	
	/* List of standard deviation  */
	public $standardDeviation;
	
	/* List of actions defined in  */
	public $actions;
	
	/* List of similar users */
	public $simUsers;

	public $listOfSimilarityUsers;

	public function init()
	{
		
	}

	/*This fucntion is to get top n items of the category $categoryID
	@return an array of n item IDs
	*/
	public function getTopNBestPrice($nItems, $categoryID = null){
		if($categoryID){
			$model = Bestprice::model()->findAllByAttributes(array('categoryID' => $categoryID, ));	
		}else{
			$model =  Bestprice::model()->findAll();
		}
		$list = array();
		foreach ($model as $row) {			
			$list = $list + array( $row->itemID => $row->rate, );
		}
		arsort($list);		
		return array_keys(array_slice($list, 0, $nItems, true));
	}


	/*This function is to get top n items that users most interest  in
	@return array of model
	*/
	public function getTopNMostInterest($nItems){
		$model = Mostinterest::model()->findAll();
		$list = array();
		foreach ($model as $row) {
			$list = $list + array( $row->itemID => $row->rating, );
		}
		arsort($list);		
		return array_keys(array_slice($list, 0, $nItems, true));
	}


	public function getTopNUserUser($nItems, $userID){
		$model = Useruser::model()->findAllByAttributes(array('userID' => $userID));
		$list = array();
		foreach ($model as $row) {
			$list = $list + array( $row->itemID => $row->rating, );
		}
		arsort($list);		
		return array_keys(array_slice($list, 0, $nItems, true));
	}

	public function getTopNItemItem($nItems, $itemID){
		$itemItem = Itemitem::model()->findAllBySql("SELECT * from itemitem WHERE itemID1=$itemID or itemID2=$itemID");
		$list = array();
		foreach ($itemItem as $record) {
			if($record->itemID1 == $itemID){
				$list += array($record->itemID2 => $record->ratings);
			}else{
				$list += array( $record->itemID1 => $record->ratings);
			}			
		}
		arsort($list);
		return array_keys(array_slice($list, 0, $nItems, true));
	}
	
	/* @Description: call to the functions of recommender algorithms
	 * @return: null
	 *  */
	public function main(){
		$this->behaviours = Behaviour::model()->findAll();
		$this->listUsers = array();
		$this->listItems = array();
		$this->actions = array();
		$this->userItems = array();

		foreach (Actions::model()->findAll() as $model) {
			$this->actions += array($model->action => $model->score, );
		}

		foreach ($this->behaviours as $behaviour) {
			if(in_array($behaviour->itemID, $this->listItems) == false){
				array_push($this->listItems, $behaviour->itemID);
			}
			
			if(in_array($behaviour->userID, $this->listUsers) == false){
				array_push($this->listUsers, $behaviour->userID);
			}

			//calculate array for item - item algorithm	
			$exist = false;
			foreach ($this->userItems as $userItem) {
				if($behaviour->userID == $userItem->userID && $behaviour->itemID == $userItem->itemID){
					$userItem->sum += $behaviour->times * $this->actions[$behaviour->action];
					$userItem->count += 1;
					$exist = true;
				}				
			}

			if($exist == false){
				$userItem = new Useritem;
				$userItem->userID = $behaviour->userID;
				$userItem->itemID = $behaviour->itemID;
				$userItem->sum = $behaviour->times * $this->actions[$behaviour->action];
				$userItem->count = 1;

				array_push($this->userItems, $userItem);
			}			
		}

		Useritem::model()->deleteAll();
		foreach ($this->userItems as $userItem) {
			$userItem->rating = $userItem->sum/$userItem->count;			
			$userItem->save();			
		}
		
		$this->getItemCategory();
		$this->calculateUserMean();		
		$this->calculateUserStandardDeviation();
		$this->calculateListOfSimilarityUsers();
		$this->createUserUserCF();
		$this->createItemItemCF();
		
		//get most interesting
		$this->setTopNMostInterest();
	}

	public function calculateBestPrice()
	{
		Bestprice::model()->deleteAll();
		foreach (Category::model()->findAll() as $category) {
			$model = Item::model()->findAllByAttributes(array('Category' => $category->ID, ));	
			$list = array();
			foreach ($model as $row) {
				if($row->OriginalPrice != 0 and $row->Price < $row->OriginalPrice )
					$list = $list + array( $row->ID => $row->Price/$row->OriginalPrice, );
			}
			asort($list);
			$list = array_reverse($list, true);	
			foreach (array_slice($list, 0, 10, true) as $itemID=>$rate) {
			 	$bestprice = new Bestprice;
			 	$bestprice->itemID = $itemID;
			 	$bestprice->categoryID = $category->ID;
			 	$bestprice->rate = $rate;
			 	$bestprice->save(false);
			}
		}			
	}
	
	private function getItemCategory(){
		$this->listItemCategory = array();
		$sql = "SELECT ID, Category FROM item";
		$items = Item::model()->findAllBySql($sql);
		foreach ($items as $item){
			$this->listItemCategory += array($item->ID => $item->Category);			
		}
	}

	/*@Description: get top n items that users most interest  in
	* @return: array of item IDs
	*/
	private function setTopNMostInterest(){				
		$items = array();
		foreach ($this->behaviours as $behaviour) {
			if(in_array($behaviour->itemID, $items) == false)
				$items += array($behaviour->itemID => 0);
		}	
		
		$mostInterests = array();
		foreach (array_keys($items) as $itemID) {
			$m = 0;
			$t = 0;
			foreach ($this->behaviours as $behaviour) {
				if($itemID == $behaviour->itemID){
					$m += $behaviour->times;
					$t += $behaviour->times * $this->actions[$behaviour->action];
				}
			}
			if($m > 0){
				$mInterests = new Mostinterest();
				$mInterests->itemID = $itemID;
				$mInterests->rating = $t/$m;
				$mInterests->categoryID = $this->listItemCategory[$itemID];
				
				array_push($mostInterests, $mInterests);
			}
		}
		
		Mostinterest::model()->deleteAll();

		foreach ($mostInterests as $mInterests){			
			$mInterests->save(false);
		}
	}

	/* @Description: calculate the mean of users behaviours 
	 * @return an associative array of userID => its behaviour mean
	 *  */
	private function calculateUserMean(){
		foreach ($this->listUsers as $userID) {
			$sum = 0;
			$count = 0;
			foreach ($this->behaviours as $behaviour) {
				if($behaviour->userID == $userID){
					$sum+=$behaviour->times * $this->actions[$behaviour->action];
					$count++;
				}
			}
			if($count != 0)
				$this->userMean[$userID] = $sum/$count;  
		}
	}
	
	/* This function is to calculate the standard deviation of user's behaviours 
	 * @return an associative array of userID => its standard deviation
	 *  */
	private function calculateUserStandardDeviation(){
		$this->standardDeviation = array();
		foreach ($this->listUsers as $userID){
			$sum = 0;
			foreach ($this->behaviours as $behaviour) {
				if($behaviour->userID == $userID){
					$sum+= pow($behaviour->times * $this->actions[$behaviour->action] - $this->userMean[$userID], 2);
				}
			}						
			$this->standardDeviation[$userID] = sqrt($sum);
		}
	}

	/* @Desciption: calculate the common items between userA and userB 
	 * @params: $userA: userID of userA, $userB: userID of userB
	 * @return: an array of itemID
	 * */
	private function calculateCommonItem($userA, $userB){
		$itemA = array();
		$itemB = array();
		foreach ($this->behaviours as $behaviour){
			if($behaviour->userID == $userA && in_array($behaviour->itemID, $itemA) == false){
				array_push($itemA, $behaviour->itemID);
			}
			if($behaviour->userID == $userB && in_array($behaviour->itemID, $itemB) == false){
				array_push($itemB, $behaviour->itemID);
			}
		}
		
		return array_intersect($itemA, $itemB);
	}

	/* @Description: calculate the similarity between userA and userB
	 * @params: userA: ID of user A, userB: ID of userB 
	 * @return: similarity between userA and userB
	 *  */
	private function calculateSimilarityBetweenUsers($userA, $userB){
		$commonItems = $this->calculateCommonItem($userA, $userB);
		$array = $this->getRatingOfUserForItem($userA, $userB, $commonItems);
		$ratingAs = $array[0];
		$ratingBs = $array[1];		
		
		$sum = 0;
		foreach ($commonItems as $itemID){
			$sum += ($ratingAs[$itemID] - $this->userMean[$userA]) * ($ratingBs[$itemID] - $this->userMean[$userB]);
		}

		return $sum/($this->standardDeviation[$userA] * $this->standardDeviation[$userB]);
	}
	
	/* Description: Get the rating of userID for itemID
	 * params: userID and itemID
	 * return: the rating */
	private function getRatingOfUserForItem($userA, $userB, $itemIDs){
		$ratingAs = array();
		$ratingBs = array();
		foreach ($this->behaviours as $behaviour){
			if(in_array($behaviour->itemID, $itemIDs)){
				if($behaviour->userID == $userA){
					if(in_array($behaviour->itemID, array_keys($ratingAs))){
						$value = $behaviour->times * $this->actions[$behaviour->action] + $ratingAs[$behaviour->itemID];
						unset($ratingAs[$behaviour->itemID]);
						$ratingAs += array($behaviour->itemID => $value);
					}else
						$ratingAs += array($behaviour->itemID => $behaviour->times * $this->actions[$behaviour->action]);
				}
				if($behaviour->userID == $userB){
					if(in_array($behaviour->itemID, array_keys($ratingBs))){
						$value = $behaviour->times * $this->actions[$behaviour->action] + $ratingBs[$behaviour->itemID];
						unset($ratingBs[$behaviour->itemID]);
						$ratingBs += array($behaviour->itemID => $value);
					}else
						$ratingBs += array($behaviour->itemID => $behaviour->times * $this->actions[$behaviour->action]);
				}
			}
		}
		
		return array($ratingAs, $ratingBs);
	}
	
	private function getRating($userID, $itemIDs){
		$ratings = array();
		foreach ($this->behaviours as $behaviour){
			if(in_array($behaviour->itemID, $itemIDs)){
				if($behaviour->userID == $userID){
					if(in_array($behaviour->itemID, array_keys($ratings))){
						$value = $behaviour->times * $this->actions[$behaviour->action] + $ratings[$behaviour->itemID];
						unset($ratings[$behaviour->itemID]);
						$ratings += array($behaviour->itemID => $value);
					}else
						$ratings += array($behaviour->itemID => $behaviour->times * $this->actions[$behaviour->action]);
				}
			}
		}
		
		return $ratings;
	} 

	/*Description: calculate list of similarity of users 
	*return: null
	*/
	private function calculateListOfSimilarityUsers(){
		$this->listOfSimilarityUsers = array();
		for($i = 0; $i < count($this->listUsers) - 1; $i++) {
			$sims = array();
			for($j = $i+1; $j < count($this->listUsers); $j++){
				$sims += array($this->listUsers[$j] => $this->calculateSimilarityBetweenUsers($this->listUsers[$i], $this->listUsers[$j]));
			}
			$this->listOfSimilarityUsers += array($this->listUsers[$i] => $sims);
		}
	}

	/*Description: get list of neighbors for a user
		return: list of neights as userIDs
	*/
	private function getListOfNeighbors($userID, $nNeighbors){
		$neighbors = array();
		foreach ($this->listOfSimilarityUsers as $keyEx => $valueEx) {
			if($keyEx == $userID){
				$neighbors += $valueEx;
			}else 
				foreach ($valueEx as $key => $value) {
					if($key == $userID)
						$neighbors += array($keyEx => $value);
				}
		}
		asort($neighbors);
		$neighbors = array_reverse($neighbors, true);
		if(count($neighbors) < $nNeighbors)
			return $neighbors;
		else
			return array_slice($neighbors, 0, $nNeighbors, true);
	}

	private function getItemsOfNeighbors($neighbors){
		$itemIDs = array();
		foreach($this->behaviours as $behaviour) {
			if(in_array($behaviour->userID, $neighbors) && !in_array($behaviour->itemID, $itemIDs)){
				array_push($itemIDs, $behaviour->itemID);
			}
		}

		return $itemIDs;
	}

	private function createUserUserCF(){
		$userUsers = array();
		foreach ($this->listUsers as $userID) {
			$neighbors = $this->getListOfNeighbors($userID, Yii::app()->constant->numberOfNeighbors);			
			foreach ($this->listItems as $itemID){
				$tu = 0;
				$mau = 0;
				foreach (array_keys($neighbors) as $neighborID){	
					$ratings = $this->getRating($neighborID, $this->listItems);
					
					if(isset($ratings[$itemID]) == false)
						continue;
					$tu += ($ratings[$itemID] - $this->userMean[$neighborID]) * $neighbors[$neighborID];
					$mau += $neighbors[$neighborID];
				}
				
				if($mau != 0){
					$rating = $this->userMean[$userID] + $tu/$mau;					
					$userUser = new Useruser();
					$userUser->userID = $userID;
					$userUser->itemID = $itemID;
					$userUser->rating = $rating;					
					array_push($userUsers, $userUser);
				}				
			}
		}
		Useruser::model()->deleteAll();
		foreach ($userUsers as $userUser){			
			$userUser->save(false);
		}
	}

	public function createItemItemCF(){
		$itemItems = array();
		for($i=0; $i< count($this->listItems)-1; $i++){			
			for ($j=$i+1; $j < count($this->listItems); $j++) { 
				$userIDs = $this->calculateCommonUsers($this->listItems[$i], $this->listItems[$j]);
				$tu = 0;
				$mau1 = 0;
				$mau2 = 0;
				foreach ($userIDs as $userID) {
					$rUi = 0;
					$rUj = 0;
					foreach ($this->userItems as $userItem) {
						if($userItem->userID == $userID && $userItem->itemID == $this->listItems[$i]){
							$rUi = $userItem->rating - $this->userMean[$userID];
						}else if($userItem->userID == $userID && $userItem->itemID == $this->listItems[$j]){
							$rUj = $userItem->rating - $this->userMean[$userID];
						}

						if($rUi !== 0 && $rUj !== 0)
							break;
					}
					$tu += $rUj * $rUi;
					$mau1 += pow($rUi, 2);
					$mau2 += pow($rUj, 2);
				}
				if($mau1 !== 0 && $mau2 !== 0){
					$itemItem = new Itemitem;
					$itemItem->itemID1 = $this->listItems[$i];
					$itemItem->itemID2 = $this->listItems[$j];
					$mau = sqrt($mau1) * sqrt($mau2);
					$itemItem->ratings = $mau/$tu;
					array_push($itemItems, $itemItem);
				}				
			}
		}

		Itemitem::model()->deleteAll();
		foreach ($itemItems as $itemItem) {
			$itemItem->save();
		}
	}

	public function calculateCommonUsers($itemID1, $itemID2){
		$user1 = array();
		$user2 = array();
		foreach ($this->userItems as $userItem) {
			if($userItem->itemID == $itemID1)
				array_push($user1, $userItem->userID);
			else if($userItem->itemID == $itemID2)
				array_push($user2, $userItem->userID);
		}

		return array_intersect($user1, $user2);
	}	
}

?>