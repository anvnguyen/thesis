<?php
/* @var $this CategoryurlController */
/* @var $model Categoryurl */

$this->breadcrumbs=array(
	'Categoryurls'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Categoryurl', 'url'=>array('index')),
	array('label'=>'Create Categoryurl', 'url'=>array('create')),
	array('label'=>'View Categoryurl', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Categoryurl', 'url'=>array('admin')),
);
?>

<h1>Update Categoryurl <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>