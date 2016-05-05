<?php
/* @var $this LogController */
/* @var $model Log */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'log-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Message'); ?>
		<?php echo $form->textArea($model,'Message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Code'); ?>
		<?php echo $form->textField($model,'Code',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'Code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'File'); ?>
		<?php echo $form->textField($model,'File',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'File'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Line'); ?>
		<?php echo $form->textField($model,'Line',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'Line'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Trace'); ?>
		<?php echo $form->textArea($model,'Trace',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Trace'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Time'); ?>
		<?php echo $form->textField($model,'Time'); ?>
		<?php echo $form->error($model,'Time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->