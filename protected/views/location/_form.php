<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php 
echo $form->textFieldRow(
    $model,
    'Location',
    array(
    	'class' => 'span3', 
        'prepend' => 'Location', 
        'id' => 'Name_Location'
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
            'onclick'=>'createLocation();',
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

<script>
function createLocation()
{
    var data = {
        'Location': $('#Name_Location').val(),
    };    

    $.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->createAbsoluteUrl("location/create"); ?>',
        data: data,
        success:function(data){
            $('#Website_LocationID').append('<option value="' + data + '">' + data + '</option>');
        },
        error: function(data) { // if error occured
            alert("Error occured.please try again");
            alert(data);
        },
        dataType:'html'
    }); 
}

</script>