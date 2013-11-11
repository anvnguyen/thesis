<?php

header( "content-type: text/html; charset=utf-8" );

class CrawlerController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actionGetTidyHTML()
	{
		if(isset($_POST['Website']))
		{
			//TODO: get and return repaired HTML
			$post = $_POST['Website'];			
			$name = $post[0];
			$url = $post[1];
			$rawHTML = Yii::app()->crawler->getRawHTML($url);
			$tidyHTML = Yii::app()->crawler->getTidyHTML($rawHTML);

			//save these data to database
			$website = new Website;
			$website->Name = $name;
			$website->URL = $url;
			$location = Location::model()->findByAttributes(array('Location' => $post[2]));
			$website->LocationID = $location->ID;
			$website->RawHTML = $rawHTML;
			$website->TidyHTML = $tidyHTML;

			$website->save(false);

			Yii::app()->session['current_web_id'] = $website->ID;

			$response = array();
			$response['RawHTML'] = $rawHTML;
			$response['TidyHTML'] = $tidyHTML;
			echo json_encode($response);
			die();
		}else
		{
			echo json_encode('No URL provided');
		}
	}

	
	public function actionAdmin()
	{		
		$url = '';
		$TidyHTML = '';
		$RawHTML = '';
		if(isset($_POST['url']))
		{
			$url = $_POST['url'];			
			$RawHTML = Yii::app()->crawler->getRawHTML($url);
			$TidyHTML = Yii::app()->crawler->getContentURL($url);

			//save to db 
			$website = new Website;
			$website->Name = $url;
			$website->URL = $url;
			$website->RawHTML = $RawHTML;
			$website->TidyHTML = $TidyHTML;

			if($website->save(false) == false)
			{
				var_dump($website->getErrors());
				die();
			}

 			$this->renderPartial('admin', array('url' => $url, 'TidyHTML' => $TidyHTML, 'RawHTML' => $RawHTML));
 			die();
		}
		$this->render('admin', array('url' => $url, 'TidyHTML' => $TidyHTML, 'RawHTML' => $RawHTML));
	}

	public function actionTest()
	{
		var_dump(Yii::app()->crawler->getContentURL("http://www.nhommua.com/tp-ho-chi-minh/cafe-am-thuc/"));
	}

}
