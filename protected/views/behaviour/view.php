<?php
/* @var $this BehaviourController */
/* @var $model Behaviour */

$this->breadcrumbs=array(
	'Behaviours'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Behaviour', 'url'=>array('index')),
	array('label'=>'Create Behaviour', 'url'=>array('create')),
	array('label'=>'Update Behaviour', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Behaviour', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Behaviour', 'url'=>array('admin')),
);
?>

<h1>View Behaviour #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'userID',
		'action',
		'itemID',
		'time',
	),
)); ?>
