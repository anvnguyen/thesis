<?php
/* @var $this BehaviourController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Behaviours',
);

$this->menu=array(
	array('label'=>'Create Behaviour', 'url'=>array('create')),
	array('label'=>'Manage Behaviour', 'url'=>array('admin')),
);
?>

<h1>Behaviours</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
