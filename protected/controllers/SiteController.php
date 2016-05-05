<?php

class SiteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actionSchedule()
	{
		try {
			//start crawl
			foreach (Website::model()->findAll() as $website) {
				Yii::app()->extractor->extractWebsite($website->ID);
			}

			//start recommender algorithm
			Yii::app()->recommender->main();

			//start send recommend email
			Yii::app()->sendemail->sendRecommenderMail();

			die("success");
		} catch (CException $e) {
			$log = new Log;
			$log->Message = $e->getMessage();
			$log->Code = $e->getCode();
			$log->File = $e->getFile();
			$log->Line = $e->getLine();
			$log->Trace = Yii::app()->extractor->trace2String($e->getTrace());
			$log->URL = 'Schedule task';
			$log->save(false);

			echo 'Exception occur';
		}		
	}
	
	public function actionTest()
	{
		// print_r('<pre>');
		// var_dump(Yii::app()->recommender->getTopNItemItem(3, 7000));
		// print_r('</pre>');

		// die();
		// print_r('<pre>');
		// Yii::app()->recommender->main();
		// print_r('</pre>');
		// die();
		// Yii::import('ext.yii-mail.YiiMailMessage');
  //       $message            = new YiiMailMessage;
  //         //this points to the file test.php inside the view path
  //      // $message->view = "test";
  //      $message->subject    = 'My TestSubject';
  //      $message->setBody('<h1>this is test mail</h1>', 'text/html');                
  //      $message->addTo('nguyen.tran@softfoundry.com');
  //      $message->from = 'hotdealbk@gmail.com';   
  //      $message->attach(Swift_Attachment::fromPath('test.pdf'));
  //      Yii::app()->mail->send($message);  
		// $messageBody = Yii::app()->sendemail->generateMessageBodyForRecommendMail("", "", "");
		// Yii::app()->sendemail->send($messageBody, "Giới thiệu sản phẩm", "an.cse09@gmail.com");

		// var_dump(Yii::app()->extractor->getPrice("150000-47"));
		// var_dump(Yii::app()->extractor->getPrice("150000đ"));
		// var_dump(Yii::app()->extractor->getPrice("150.000"));

		// Yii::app()->extractor->extractImageURL(
		// 	"//div[@class='viewer iviewer_cursor c30']/img/attribute::src"
		// 	);
		// die(Yii::app()->crawler->getRawHTML("http://www.zalora.vn/Ao-So-Mi-In-Hoa-Tiet-Tay-Ngan-Nam-89907.html"));
		Yii::app()->recommender->calculateBestPrice();
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}