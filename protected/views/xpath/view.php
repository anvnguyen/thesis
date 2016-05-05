<?php
/* @var $this XpathController */
/* @var $model Xpath */

$this->breadcrumbs=array(
	'Xpaths'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Xpath', 'url'=>array('index')),
	array('label'=>'Create Xpath', 'url'=>array('create')),
	array('label'=>'Update Xpath', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Xpath', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Xpath', 'url'=>array('admin')),
);
?>

<h1>View Xpath #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'WebsiteID',
		'CategoryID',
		'Name',
		'Price',
		'Purchases',
		'URL',
		'ImageURL',
		'Location',
		'Address',
	),
)); ?>
