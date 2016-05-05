<?php

class BehaviourService
{
	public function init()
	{
		
	}

	/**/
	public function addBehaviour($userID, $action, $itemID)
	{
		$user = User::model()->findByPk($userID);
		if($user == null)
			die("User not defined");

		$actionModel = Actions::model()->findByPk($action);
		if($actionModel == null)
			die("Action not defined");

		$item = Item::model()->findByPk($itemID);
		if($item == null)
			die("Item not defined");

		$behaviour = Behaviour::model()->findByAttributes(array('userID' => $userID, 'action' => $action, 'itemID' => $itemID));
		if($behaviour == null){
			$behaviour = new Behaviour;
			$behaviour->userID = $userID;
			$behaviour->action = $action;
			$behaviour->itemID = $itemID;
			$behaviour->times = 1;

			if($behaviour->save())
				return "Success";
			else
				return $behaviour->errors;
		}else{
			$behaviour->times += 1;
			if($behaviour->save())
				return "Success";
			else
				return $behaviour->errors;
		}		
	}	
}

?>