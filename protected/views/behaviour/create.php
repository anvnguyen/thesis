<?php
/* @var $this BehaviourController */
/* @var $model Behaviour */

$this->breadcrumbs=array(
	'Behaviours'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Behaviour', 'url'=>array('index')),
	array('label'=>'Manage Behaviour', 'url'=>array('admin')),
);
?>

<h1>Create Behaviour</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>