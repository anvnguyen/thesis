<?php

class Recommender
{	
	public function init()
	{
		
	}

	/*This fucntion is to get top n items of the category $categoryID
	@return an array of n item IDs
	*/
	public function getTopNBestPrice($categoryID, $nItems){
		$model = Item::model()->findAllByAttributes(array('Category' => $categoryID, ));
		$list = array();
		foreach ($model as $row) {
			if($row->OriginalPrice !== 0 and $row->Price < $row->OriginalPrice )
			$list = $list + array( $row->ID => $row->Price/$row->OriginalPrice, );
		}
		asort($list);		
		return array_keys(array_slice($list, 0, $nItems, true));
	}


	/*This function is to get top n items that users most interest  in
	@return array of model
	*/

	public function getTopNMostInterest($nItems){
		$behaviour = Behaviour::model()->findAll();

		print_r('<pre>');
		var_dump($behaviour);
		print_r('</pre>');
		die();
	}
}

?>