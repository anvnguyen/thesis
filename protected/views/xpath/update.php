<?php
/* @var $this XpathController */
/* @var $model Xpath */

$this->breadcrumbs=array(
	'Xpaths'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Xpath', 'url'=>array('index')),
	array('label'=>'Create Xpath', 'url'=>array('create')),
	array('label'=>'View Xpath', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Xpath', 'url'=>array('admin')),
);
?>

<h1>Update Xpath <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>