<?php
/* @var $this XpathController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Xpaths',
);

$this->menu=array(
	array('label'=>'Create Xpath', 'url'=>array('create')),
	array('label'=>'Manage Xpath', 'url'=>array('admin')),
);
?>

<h1>Xpaths</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
