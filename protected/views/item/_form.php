<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Price'); ?>
		<?php echo $form->textField($model,'Price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'Price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Category'); ?>
		<?php echo $form->textField($model,'Category'); ?>
		<?php echo $form->error($model,'Category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ImageURL'); ?>
		<?php echo $form->textField($model,'ImageURL',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'ImageURL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Update'); ?>
		<?php echo $form->textField($model,'Update'); ?>
		<?php echo $form->error($model,'Update'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Purchases'); ?>
		<?php echo $form->textField($model,'Purchases'); ?>
		<?php echo $form->error($model,'Purchases'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Website'); ?>
		<?php echo $form->textField($model,'Website'); ?>
		<?php echo $form->error($model,'Website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'URL'); ?>
		<?php echo $form->textField($model,'URL',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'URL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Location'); ?>
		<?php echo $form->textField($model,'Location'); ?>
		<?php echo $form->error($model,'Location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'Address'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->