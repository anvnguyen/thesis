<?php
/* @var $this ActionsController */
/* @var $model Actions */

$this->breadcrumbs=array(
	'Actions'=>array('index'),
	$model->action,
);

$this->menu=array(
	array('label'=>'List Actions', 'url'=>array('index')),
	array('label'=>'Create Actions', 'url'=>array('create')),
	array('label'=>'Update Actions', 'url'=>array('update', 'id'=>$model->action)),
	array('label'=>'Delete Actions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->action),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Actions', 'url'=>array('admin')),
);
?>

<h1>View Actions #<?php echo $model->action; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'action',
		'description',
	),
)); ?>
