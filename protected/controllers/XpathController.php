<?php

class XpathController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			// 'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
// 			array('deny',  // deny all users
// 				'users'=>array('*'),
// 			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$item = $this->tryXpath($id);		
		$this->renderPartial('_view', array('item' => $item));
	}
	
	public function actionTest3()
	{
		Yii::app()->extractor->extractWebsite(14);
		echo "done";
	}
	
	private function tryXpath($xpathID)
	{
		$xpath = Xpath::model()->findByPk($xpathID);
		$item = Yii::app()->extractor->extractItem($xpath->WebsiteID);	
		return $item;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Xpath;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Name']))
		{			
			$model->Name=$_POST['Name'];
			$model->Price=$_POST['Price'];
			$model->Address=$_POST['Address'];
			$model->Purchases=$_POST['Purchases'];
			$model->ImageURL=$_POST['ImageURL'];
			$model->WebsiteID = Yii::app()->session['current_web_id'];
			
			if($model->save(false))
			{
				echo 'save successfully';
				die(); 
			}else{
				echo 'save fails';
				die();
			}
		}

		$this->renderPartial('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Xpath']))
		{
			$model->attributes=$_POST['Xpath'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Xpath');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin2()
	{
		$model=new Xpath();
		//check if there exists any xpath
		$websiteID = Yii::app()->session['current_web_id'];
		$model = Xpath::model()->findByAttributes(array('WebsiteID' => $websiteID));
		if($model == null){
			$model = new Xpath();
		}
		$this->render('create', array('model' => $model));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Xpath();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Xpath']))
				$model->attributes=$_GET['Xpath'];
	
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Xpath the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Xpath::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Xpath $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='xpath-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionRepairHTML()
	{
		if(isset($_REQUEST['url'])){
			echo Yii::app()->crawler->getContentURL($_REQUEST['url']);
		}else{
			echo "No URL provided";
		}
	}
	
	public function actionTest()
	{
		$str = 'In My Cart : 11 12 items';
		preg_match_all('!\d+!', $str, $matches);
		var_dump(implode("", $matches[0]));		
	}
	
	public function actionTryXpath()
	{
		if(isset($_POST["xpath"]))
		{	
			echo Yii::app()->extractor->extractOneXpath(Yii::app()->session['current_web_id'], $_POST["xpath"]);
			die();
		}else{
			echo "No xpath or attribute provided";
		}
	}
	
	public function actionTryAll()
	{
		if(isset($_POST["Xpath"])){
			$model = new Xpath();
			$model->attributes = $_POST["Xpath"];					
			$item = Yii::app()->extractor->extractItem(Yii::app()->session['current_web_id'], $model);
			var_dump($item);
			die();
			$this->renderPartial('_view', array('item' => $item));
		}else{
			echo "No xpath or attribute provided";
		}
	}
}
