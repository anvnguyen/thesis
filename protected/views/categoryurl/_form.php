<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'category_form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<?php 
echo $form->textFieldRow(
    $model,
    'URL',
    array(
    	'class' => 'span6', 
        'id' => 'URL_Category'
    )
);
?>  

<?php 
echo $form->dropDownListRow(
    $model, 
    'CategoryID', 
    Category::getCategoryNames(), 
    array(
        'class' => 'span3', 
        'id' => 'name_category'
    )
); 
?>
<?php 
echo $form->dropDownListRow(
	$model, 
	'LocationID', 
	Location::getLocations(), 
    array(
        'class' => 'span3', 
        'id' => 'location'
    )
); 
?>
<div class="controls">
    <?php
        $this->widget('bootstrap.widgets.TbButton', array( 
            'type'=>'btn', 
            'icon' => 'icon-plus-sign',
            'label'=>'Add new category',
            'size' => 'small',
            'htmlOptions'=>array(
                'onclick'=>'addCategory()',
            ),
        ));
    ?>
</div>

<div class="modal-footer" id="modal_footer">
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Create',
        'htmlOptions'=>array(
            'onclick'=>'createCategoryUrl()',
            ),
    )); 
    ?>
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cancel',
        'htmlOptions'=>array('onclick'=>'cancel()'),
    )); 
    ?>
</div>

<?php $this->endWidget(); ?>

<script>

function cancel()
{
	window.location = <?php echo "'" . Yii::app()->createUrl("website/admin") . "'";   ?>  
}

function addCategory()
{
    $.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->createUrl("category/create"); ?>',
        success:function(data){
            $('#new_category').html(data);
            $('#category_modal').modal({show: true});
        },
        error: function(data) { // if error occured
            alert(data);
        },
        dataType:'html'
    });
}
    
function createCategoryUrl()
{
    $.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->createAbsoluteUrl("categoryUrl/create"); ?>',
        data: $("#category_form").serialize(),
        success:function(data){
        	if(data!=="success"){
                $("#category_form").html(data);
            }else{
                $.fn.yiiGridView.update('category_grid');
            }
        },
        error: function(data) { 
            alert("Error occured.please try again");
            alert(data);
        },
        dataType:'html'
    }); 
}

</script>