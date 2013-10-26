<?php

class AdminController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	public function actionIndex()
	{
		// $this->redirect(array('item/admin'));
		$this->render('index');
	}

	public function actionGetPartialView()
	{
		if(isset($_POST['page']))
		{
			switch ($_POST['page']) {
				case 'website':
					$this->redirect(array('website/admin'));
					break;
				
				default:
					# code...
					break;
			}
		}

	}

}