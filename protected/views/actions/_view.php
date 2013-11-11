<?php
/* @var $this ActionsController */
/* @var $data Actions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('action')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->action), array('view', 'id'=>$data->action)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>