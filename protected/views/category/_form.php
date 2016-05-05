<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php 
echo $form->textFieldRow(
    $model,
    'Name',
    array(
    	'class' => 'span7', 
		'id' => 'Category',
    )
);
?>  

<?php $this->endWidget(); ?>

<div class="modal-footer" id="modal_footer">
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Create',
        'htmlOptions'=>array(
            'onclick'=>'createCategory();',
            'data-dismiss'=>'modal'
            ),
    )); 
    ?>
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cancel',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); 
    ?>
</div>

</div><!-- form -->
    
<script>
function createCategory()
{
    var data = {
        'Category': $('#Category').val(),
    };    

    $.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->createAbsoluteUrl("category/create"); ?>',
        data: data,
        success:function(data){
            $('#name_category').append('<option value="' + data + '">' + data + '</option>');
        },
        error: function(data) { // if error occured
            alert("Error occured.please try again");
            alert(data);
        },
        dataType:'html'
    }); 
}

</script>