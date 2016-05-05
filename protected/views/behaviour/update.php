<?php
/* @var $this BehaviourController */
/* @var $model Behaviour */

$this->breadcrumbs=array(
	'Behaviours'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Behaviour', 'url'=>array('index')),
	array('label'=>'Create Behaviour', 'url'=>array('create')),
	array('label'=>'View Behaviour', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Behaviour', 'url'=>array('admin')),
);
?>

<h1>Update Behaviour <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>