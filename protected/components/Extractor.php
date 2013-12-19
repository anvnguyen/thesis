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
		$log = new Log;
		$log->Message = "Crawl website " . $site->Name;
		$log->Code = $site->ID;
		$log->URL = $site->URL;
		$log->save(false);
		
		foreach ($categoryURL as $cateUrl){
			$urls = $this->extractItemURLs($cateUrl->URL);
			$items = array();
			foreach ($urls as $url) {	
				$item = $this->extractItem($xpath, $url);
				if($this->checkItem($item)){
					$item->Website = $cateUrl->WebsiteID;
					$item->Category = $cateUrl->CategoryID;
					$item->Location = $cateUrl->LocationID;
					$item->URL = $url;
					array_push($items, $item);
				}
			}
			Item::model()->deleteAllByAttributes(array('Website' => $siteID));
			foreach ($items as $item) {				
				$item->save(false);
			}
		}	

		$site->save(false);
	}

	private function checkItem($item)
	{
		if($item == null)
			return false;
		if($item->Name == null or $item->Name = '')
			return false;
		if($item->Price == null or $item->Price = '')
			return false;
		return true;
	}
	
	//extract only one item to see if the xpath is correct or not
	public function extractItem($xpath, $url=null)
	{	
		try {
			if($url==null){
				$url = $xpath->URL;
			}
			$tidyHTML = Yii::app()->crawler->getContentURL($url);	
			$doc = new DomDocument();
			@$doc->loadHTML($tidyHTML);
			$domXpath = new DomXpath($doc);
		
			$item = new Item();		

			//get Name
			if($xpath->Name != ''){
				$node = $domXpath->query($xpath->Name);
				if($node != null and $node->length != 0)
					$item->Name = $node->item(0)->nodeValue; 
			}			

			//get Price
			if($xpath->Price != ''){
				$node = $domXpath->query($xpath->Price);
				if($node != null and $node->length !== 0)
					$item->Price = $node->item(0)->nodeValue;
			}		

			//get OriginalPrice
			if($xpath->OriginalPrice != ''){
				$node = $domXpath->query($xpath->OriginalPrice);
				if($node != null and $node->length !== 0)
					$item->OriginalPrice = $node->item(0)->nodeValue;
			}

			//get Purchases
			if($xpath->Purchases != ''){
				$node = $domXpath->query($xpath->Purchases);
				if($node != null and $node->length !== 0)
					$item->Purchases = $node->item(0)->nodeValue;
			}		

			//get Image URL
			if($xpath->ImageURL != ''){
				$node = $domXpath->query($xpath->ImageURL);
				if($node != null and $node->length !== 0)
					$item->ImageURL = $node->item(0)->value;
			}						

			//get Description
			if($xpath->Description != ''){
				$node = $domXpath->query($xpath->Description);
				if($node != null and $node->length !== 0)
					$item->Description = $node->item(0)->nodeValue;	
			}					

			//get Condition
			if($xpath->Condition != ''){
				$node = $domXpath->query($xpath->Condition);
				if($node != null and $node->length !== 0)
					$item->Condition = $node->item(0)->nodeValue;
			}
			

			//get address
			if($xpath->Address != ''){
				$node = $domXpath->query($xpath->Address);
				if($node != null and $node->length !== 0)
					$item->Address = $node->item(0)->nodeValue;
			}		

			return $item;
		} catch (CException $e) {
			$log = new Log;
			$log->Message = $e->getMessage();
			$log->Code = $e->getCode();
			$log->File = $e->getFile();
			$log->Line = $e->getLine();
			$log->Trace = $this->trace2String($e->getTrace());
			$log->URL = $url;
			$log->save(false);

			return NULL;
		}				
	}

	public function trace2String($trace)
	{
		$result = '';
		foreach ($trace as $line) {
			$result += $line['file'];
			$result += '(' . $line['line'] . '): ';
			$result += $line['class'];
			$result += $line['type'];
			$result += $line['function'] . '()';
			$result += ';';
		}

		return $result;
	}
	
	//extract using only one xpath to see if this xpath is correct or not
	public function extractOneXpath($xpath, $url)
	{
		if($xpath=='')
			return ':( xpath cannot be empty';
		$tidyHTML = Yii::app()->crawler->getContentURL($url);
		$doc = new DomDocument();
		@$doc->loadHTML($tidyHTML);
		$domXpath = new DomXpath($doc);		
		$node = $domXpath->query($xpath);
		if($node == null || $node->length == 0){
			return ':( Extract failed';
		}else{
			return $node->item(0)->nodeValue;
		}
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