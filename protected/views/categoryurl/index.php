<?php
/* @var $this CategoryurlController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categoryurls',
);

$this->menu=array(
	array('label'=>'Create Categoryurl', 'url'=>array('create')),
	array('label'=>'Manage Categoryurl', 'url'=>array('admin')),
);
?>

<h1>Categoryurls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
