<?php

class WebsiteController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('create','update', 'update2', 'crawl'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionViewHTML()
	{
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Website;
		$xpath = new Xpath;
		$categoryURL = new CategoryURL;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Website'])){
			$model->attributes=$_POST['Website'];
			if($model->save()){				
				$this->redirect(array('view','id'=>$model->ID));
			}				
		}

		Yii::app()->session['current_web_id'] = null;
		$this->render('create',array(
			'model'=>$model,
			'xpath'=>$xpath,
			'categoryURL' => $categoryURL,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		Yii::app()->session['current_web_id'] = $id;
		$model=$this->loadModel($id);
		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdate2()
	{
		if(isset($_POST['Website'])){
			if(Yii::app()->session['current_web_id'] != ""){
				$model = Website::model()->findByPk(Yii::app()->session['current_web_id']);
				$model->attributes=$_POST['Website'];
				if($model->save(false))
					die("success");
			}else{
				$model = new Website;
				$model->setAttributes($_POST['Website']);
				if($model->save(false)){
					Yii::app()->session['current_web_id'] = Website::model()->findByAttributes(array('URL' => $model->URL))->ID;
					die("success");
				}			
			}			
		}
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
		$dataProvider=new CActiveDataProvider('Website');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Website('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Website']))
			$model->attributes=$_GET['Website'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCrawl()
	{
		Yii::app()->extractor->extractWebsite($_REQUEST['id']);
		$this->redirect(Yii::app()->createUrl('website/admin'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Website the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Website::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Website $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='website-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	// public function actionCrawlWebsite()
	// {
	// 	Yii::app()->extractor->extractWebsite(24);
	// 	echo "done";
	// }
}
