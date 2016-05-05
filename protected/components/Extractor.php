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
		$site->saveAttributes(array('LastCrawl'));
		$categoryURL = Categoryurl::model()->findAllBySql("SELECT * FROM categoryURL WHERE WebsiteID = '$siteID'");
		$log = new Log;
		$log->Message = "Start crawling website " . $site->Name;
		$log->Code = $site->ID;
		$log->URL = $site->URL;
		$log->save(false);
		//back up before delete
		Item::model()->deleteAllByAttributes(array('Website' => $siteID));
		
		foreach ($categoryURL as $cateUrl){
			$urls = $this->extractItemURLs($cateUrl->URL);
			$items = array();
			// print_r('<prev>');
			foreach ($urls as $url) {
				$item = $this->extractItem($xpath, $url, $site->URL);
				// var_dump($item->attributes);
				if($this->checkItem($item)){
					$item->Website = $cateUrl->WebsiteID;
					$item->Category = $cateUrl->CategoryID;
					$item->Location = $cateUrl->LocationID;
					$item->URL = $this->normalizeURL($url, $site->URL);
					array_push($items, $item);
					$item->save(false);
				}
			}
			// print_r('</prev>');
			// die();
			
			// foreach ($items as $item) {				
			// 	$item->save(false);
			// }

			}
		}	

		
		$log = new Log;
		$log->Message = "Finish crawling website " . $site->Name;
		$log->Code = $site->ID;
		$log->URL = $site->URL;
		$log->save(false);
	}

		
	//extract only one item to see if the xpath is correct or not
	public function extractItem($xpath, $url=null, $websiteURL=null)
	{	
		try {
			if($url==null){
				$url = $xpath->URL;
			}else{
				$url = $this->normalizeURL($url, $websiteURL);
			}
			// var_dump($url);
			$tidyHTML = Yii::app()->crawler->getContentURL($url);	
			$doc = new DomDocument();
			@$doc->loadHTML($tidyHTML);
			$domXpath = new DomXpath($doc);
		
			$item = new Item();		

			//get Name
			if($xpath->Name != ''){
				$node = $domXpath->query($xpath->Name);
				if($node != null and $node->length !== 0)
					$item->Name = $node->item(0)->nodeValue; 
			}			

			//get Price
			if($xpath->Price != ''){
				$node = $domXpath->query($xpath->Price);
				if($node != null and $node->length !== 0){					
					$item->Price = $this->getPrice($node->item(0)->nodeValue);
				}					
			}		

			//get OriginalPrice
			if($xpath->OriginalPrice != ''){
				$node = $domXpath->query($xpath->OriginalPrice);
				if($node != null and $node->length !== 0){
					$item->OriginalPrice = $this->getPrice($node->item(0)->nodeValue);
				}
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

	public function extractImageURL($xpath)
	{
		$items = Item::model()->findAllByAttributes(array('Website' => 44, 'ImageURL'=>''));
		foreach ($items as $item) {
			$item->ImageURL = $this->extractOneXpath($xpath, $item->URL);			
		}

		foreach ($items as $item) {
			$item->save(false);
		}
		die("success");
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
			$url = @$query->attributes->item(1)->nodeValue;
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

	private function checkItem($item)
	{
		if(empty($item))
			return false;
		if(empty($item->Name))
			return false;
		if(empty($item->Price))
			return false;
		return true;
	}

	public function normalizeURL($url, $websiteURL)
	{
		if(substr($url, 0, 1) == "/"){
			return $websiteURL . $url;
		}else
			return $url;
	}

	public function getPrice($str) {
		if(empty($str) or $str == " " or $str == null or $str=="") return $str;
        preg_match_all('/\d+/', filter_var($str, FILTER_SANITIZE_NUMBER_INT), $matches);
        if(count($matches[0]) >= 1){
        	return $matches[0][0];
        }else{
        	return $str;
        }        
    }
}

?>