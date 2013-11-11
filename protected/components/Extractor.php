<?php

//To encode the html content to utf-8 
header( "content-type: text/html; charset=utf-8" );

class Extractor
{
	public function init()
	{
		
	}
	
	public function extractWebsite($siteID)
	{
		$xpath = Xpath::model()->findByAttributes(array('WebsiteID' => $siteID));
		$site = Website::model()->findByPk($xpath->WebsiteID);
		$categoryURL = Categoryurl::model()->findAllBySql("SELECT * FROM categoryURL WHERE WebsiteID = '$siteID'");
		
		foreach ($categoryURL as $url){
			$this->getItemsFromCategoryURL($url, $site, $xpath, "many");		
		}	
		return 'success';
	}
	
	//extract only one item to see if the xpath is correct or not
	public function extractItem($siteID, $xpath)
	{	
		$site = Website::model()->findByPk($siteID);
		$categoryURL = Categoryurl::model()->findByAttributes(array('WebsiteID' => $siteID));
		Yii::app()->crawler->getContentURL($site->URL);
		$urls = $this->extractItemURLs($categoryURL->URL);
		foreach ($urls as $url) {
			$tidyHTML = Yii::app()->crawler->getContentURL($url);		
			//create new Dom document & Dom Xpath
			$doc = new DomDocument();
			@$doc->loadHTML($tidyHTML);
			$domXpath = new DomXpath($doc);
		
			$node = $domXpath->query($xpath->Name); // returns a DOMNodeList
			if($node->length == 0){
				continue;
			}else{
				$item = new Item();
				//get Name
				$item->Name = $node->item(0)->nodeValue; // get the first node in the list which is a DOMAttr
				//get Price
				$node = $domXpath->query($xpath->Price);
				if($node->length !== 0)
					$item->Price = $node->item(0)->nodeValue;
	
				//get OriginalPrice
				$node = $domXpath->query($xpath->OriginalPrice);
				if($node->length !== 0)
					$item->OriginalPrice = $node->item(0)->nodeValue;
	
	
				//get Purchases
				$node = $domXpath->query($xpath->Purchases);
				if($node->length !== 0)
					$item->Purchases = $node->item(0)->nodeValue;
	
				//get Image URL
				$node = $domXpath->query($xpath->ImageURL);
				if($node->length !== 0)
					$item->ImageURL = $node->item(0)->value;				

				//get Description
				$node = $domXpath->query($xpath->Description);
				if($node->length !== 0)
					$item->Description = $node->item(0)->nodeValue;				

				//get Condition
				$node = $domXpath->query($xpath->Condition);
				if($node->length !== 0)
					$item->Condition = $node->item(0)->nodeValue;
	
				//get address
				$node = $domXpath->query($xpath->Address);
				if($node->length !== 0)
					$item->Address = $node->item(0)->nodeValue;
				return $item;				
			}
		}
		
		return ':( Extract failed';
	}
	
	//extract using only one xpath to see if this xpath is correct or not
	public function extractOneXpath($siteID, $xpath)
	{
		$site = Website::model()->findByPk($siteID);
		$categoryURL = Categoryurl::model()->findByAttributes(array('WebsiteID' => $siteID));
		$urls = $this->extractItemURLs($categoryURL->URL);
		foreach ($urls as $url) {
			$tidyHTML = Yii::app()->crawler->getContentURL($url);
		
			//create new Dom document & Dom Xpath
			$doc = new DomDocument();
			@$doc->loadHTML($tidyHTML);
			$domXpath = new DomXpath($doc);
		
			$node = $domXpath->query($xpath); // returns a DOMNodeList
			if($node == null || $node->length == 0){
				continue;
			}else{
				if($node->length !== 0)
					return $node->item(0)->nodeValue;
				else 
					return ':( Extract failed';
			}
		}
		
		return ':( Extract failed';
	}
	
	//category: model of categoryURL
	private function getItemsFromCategoryURL($categoryURL, $site, $xpath, $option)
	{
		$urls = $this->extractItemURLs($categoryURL->URL);
		$items = array();
		//for each url, craw the html and then apply xpath extract
		foreach ($urls as $url) {
			$tidyHTML = Yii::app()->crawler->getContentURL($url);
	
			//create new Dom document & Dom Xpath
			$doc = new DomDocument();
			@$doc->loadHTML($tidyHTML);
			$domXpath = new DomXpath($doc);
	
			$node = $domXpath->query($xpath->Name); // returns a DOMNodeList
			if($node == null || $node->length == 0)
			{
				continue;
			}else{
				$item = new Item;
				//set website
				$item->Website = $site->ID;
	
				//set category
				$item->Category = $categoryURL->CategoryID;
	
				//set location
				$item->Location = $site->LocationID;
	
				//set URL
				$item->URL = $url;
	
				//get Name
				$item->Name = $node->item(0)->nodeValue; // get the first node in the list which is a DOMAttr
				//get Price
				$node = $domXpath->query($xpath->Price);
				if($node->length !== 0){
					preg_match_all('!\d+!', $node->item(0)->nodeValue, $matches);
					$item->Price = implode("", $matches[0]);
				}					
	
				//get OriginalPrice
				$node = $domXpath->query($xpath->OriginalPrice);
				if($node->length !== 0){
					preg_match_all('!\d+!', $node->item(0)->nodeValue, $matches);
					$item->OriginalPrice = implode("", $matches[0]);
				}					
	

				//get Purchases
				$node = $domXpath->query($xpath->Purchases);
				if($node->length !== 0)
					$item->Purchases = $node->item(0)->nodeValue;
	
				//get Image URL
				$node = $domXpath->query($xpath->ImageURL);
				if($node->length !== 0)
					$item->ImageURL = $node->item(0)->value;
	
				//get address
				$node = $domXpath->query($xpath->Address);
				if($node->length !== 0)
					$item->Address = $node->item(0)->nodeValue;
				//get Description
				$node = $domXpath->query($xpath->Description);
				if($node->length !== 0){
					$item->Description = $node->item(0)->nodeValue;
				}					
				
				//get Condition
				$node = $domXpath->query($xpath->Condition);
				if($node->length !== 0)
					$item->Condition = $node->item(0)->nodeValue;
				
				//add to array
				if($option == "one")
					return $item;
				else{
					//TODO: check if this item exists or not					
					$item->save(false);
				}					
			}
		}
		
		return 'success';
	}
	
	private function extractItemURLs($url)
	{
		$TidyHTML = Yii::app()->crawler->getContentURL($url);
		$results = $this->getHtmlTags($TidyHTML, 'a');
	
		$array = array();
		foreach ($results as $query) {
			$url = @$query->attributes->item(0)->nodeValue;
			if($this->checkLink($url) && !in_array($url, $array)){				
				array_push($array, $url);
			}
		}
	
		return $array;
	}
	
	private function checkLink($str)
	{
		if(strpos($str, 'mailto') !== false)
			return false;
	
		if(strpos($str, '/') == false && strpos($str, '/') !== 0)
			return false;
		
		if(strlen(trim($str)) == 0)
			return false;
	
		if($str == null)
			return false;
	
		return true;
	}
	
	private function getHtmlTags($html_source, $tag)
	{
		$doc = new DomDocument();
		@$doc->loadHTML($html_source);
		$xpath = new DomXpath($doc);
		$query = sprintf('//%s', $tag);
		return $xpath->query($query);
	}
}

?>