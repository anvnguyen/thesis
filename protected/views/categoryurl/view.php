<?php
/* @var $this CategoryurlController */
/* @var $model Categoryurl */

$this->breadcrumbs=array(
	'Categoryurls'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Categoryurl', 'url'=>array('index')),
	array('label'=>'Create Categoryurl', 'url'=>array('create')),
	array('label'=>'Update Categoryurl', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Categoryurl', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Categoryurl', 'url'=>array('admin')),
);
?>

<h1>View Categoryurl #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'WebsiteID',
		'CategoryID',
		'URL',
		'CategoryName',
	),
)); ?>
