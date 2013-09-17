<?php

class CrawlerController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actionAdmin()
	{
		$crawler = new Crawler;
		$url = '';
		$TidyHTML = '';
		$RawHTML = '';
		if(isset($_POST['url']))
		{
			$RawHTML = Yii::app()->crawler->getRawHTML($_POST['url']);
			$TidyHTML = Yii::app()->crawler->getContentURL($_POST['url']);

 			$this->renderPartial('admin', array('url' => $url, 'TidyHTML' => $TidyHTML, 'RawHTML' => $RawHTML));
 			die();
		}
		$this->render('admin', array('url' => $url, 'TidyHTML' => $TidyHTML, 'RawHTML' => $RawHTML));
	}

	public function actionGetHTMLContent()
	{
		$data = Yii::app()->crawler->getContentURL('http://muachung.vn/danh-muc/c-9/quan-an.html');

		// file_put_contents('data.html', $data);
		// die();

		$doc = new DomDocument();
		@$doc->loadHTML($data);

		$xpath = new DomXpath($doc);
		 
		$banchaynhat = $xpath->query("//div[@class='v6ItemCon v6ItemContent']");
		$entries = $xpath->query("//div[@class='list-rands-over list-rands box-frame-center']");
		$entriesc11 = $xpath->query("//div[@class='list-rands-over list-rands box-frame-center c11']");

		// var_dump($banchaynhat);
		// var_dump($entries);
		// var_dump($entriesc11);
		// exit();
		 
		$items = array();
		 
		foreach ($banchaynhat as $entry) {		
			$item = new Item;    

		    //get URL		    
		    $node = $xpath->query("div/a/attribute::href", $entry); // returns a DOMNodeList
		    $item->URL = $node->item(0)->value;

		    //get purchases
		    $node = $xpath->query("div/div/div[@class='v7bnew f12']/b", $entry); // returns a DOMNodeList
		    $item->Purchases = $node->item(0)->nodeValue;	
	    
		    array_push($items, $item);
		}	

		foreach ($entries as $entry) {		    
			$item = new Item;    

		    //get URL		    
		    $node = $xpath->query("div/a/attribute::href", $entry); // returns a DOMNodeList
		    $item->URL = $node->item(0)->value;

		    //get purchases
		    $node = $xpath->query("div/div/div[@class='v7bnew mTop10']/b", $entry); // returns a DOMNodeList
		    $item->Purchases = $node->item(0)->nodeValue;	
	    
		    array_push($items, $item);
		}

		foreach ($entriesc11 as $entry) {		    
			$item = new Item;    

		    //get URL		    
		    $node = $xpath->query("div/a/attribute::href", $entry); // returns a DOMNodeList
		    $item->URL = $node->item(0)->value;

		    //get purchases
		    $node = $xpath->query("div/div/div[@class='v7bnew mTop10']/b", $entry); // returns a DOMNodeList
		    $item->Purchases = $node->item(0)->nodeValue;	
	    
		    array_push($items, $item);
		}

		print_r('<pre>');


		foreach ($items as $item) {
			// $item = new Item;

			$item->Category = 3;
			$item->Website = 1;			
			$item->Location = 3;
			$item->URL = $item->URL;

			$data = Yii::app()->crawler->getContentURL($item->URL);

			$doc = new DomDocument();
			@$doc->loadHTML($data);
			$xpath = new DomXpath($doc);

			//get name
		 	$node = $xpath->query("//div[@class='v3_SC_title']/h1"); // returns a DOMNodeList
		    $item->Name = $node->item(0)->nodeValue; // get the first node in the list which is a DOMAttr			

			//get price
		 	$node = $xpath->query("//div[@class='v3_SC_price']/div"); // returns a DOMNodeList
		    $item->Price = $node->item(0)->nodeValue; // get the first node in the list which is a DOMAttr	

			//get Image URL
		 	$node = $xpath->query("//div[@class='v3_sizecolor_left']/div/img/attribute::src"); // returns a DOMNodeList
		    $item->ImageURL = $node->item(0)->value; // get the first node in the list which is a DOMAttr	

		    //get address
		 	$node = $xpath->query(".//*[@id='viewline1']/div[1]"); // returns a DOMNodeList
		    $item->Address = $node->item(0)->nodeValue; // get the first node in the list which is a DOMAttr	

			$item->save(false);

			var_dump($item->URL);
		}

		print_r('</pre>');
		die();
	}

	public function actionGetDetail()
	{
		$data = Yii::app()->crawler->getContentURL('http://muachung.vn/quan-an/khaisilk-brothers-bbq-thit-nuong-sushi-42694.html');

		file_put_contents('detail.html', $data);
		die();
	}

}
