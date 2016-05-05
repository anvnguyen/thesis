<?php
/* @var $this ActionsController */
/* @var $model Actions */

$this->breadcrumbs=array(
	'Actions'=>array('index'),
	$model->action=>array('view','id'=>$model->action),
	'Update',
);

$this->menu=array(
	array('label'=>'List Actions', 'url'=>array('index')),
	array('label'=>'Create Actions', 'url'=>array('create')),
	array('label'=>'View Actions', 'url'=>array('view', 'id'=>$model->action)),
	array('label'=>'Manage Actions', 'url'=>array('admin')),
);
?>

<h1>Update Actions <?php echo $model->action; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>