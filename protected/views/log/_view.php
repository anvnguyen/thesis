<?php
/* @var $this LogController */
/* @var $data Log */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Message')); ?>:</b>
	<?php echo CHtml::encode($data->Message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Code')); ?>:</b>
	<?php echo CHtml::encode($data->Code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('File')); ?>:</b>
	<?php echo CHtml::encode($data->File); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Line')); ?>:</b>
	<?php echo CHtml::encode($data->Line); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Trace')); ?>:</b>
	<?php echo CHtml::encode($data->Trace); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Time')); ?>:</b>
	<?php echo CHtml::encode($data->Time); ?>
	<br />


</div>