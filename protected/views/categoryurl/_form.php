<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'category-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<?php 
echo $form->textFieldRow(
    $model,
    'URL',
    array(
    	'class' => 'span5', 
        'prepend' => 'URL', 
        'id' => 'URL_Category'
    )
);
?>  

<?php 
echo $form->dropDownListRow(
	$model, 
	'CategoryName', 
	Category::getCategoryNames(), 
    array(
        'class' => 'span3', 
        'id' => 'name_category'
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

<?php $this->endWidget(); ?>

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
        'htmlOptions'=>array('onclick'=>'dismiss_form()'),
    )); 
    ?>
</div>

<!-- Modal to show new category form -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'category_modal')); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>New category</h4>
    </div>
     
    <div class="modal-body">
        <div id="new_category"></div>
    </div>
 
<?php $this->endWidget(); ?>

<script>

function dismiss_form()
{
	$( "#general-info" ).toggle(false);
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
    var theContents = document.getElementById('name_category')[document.getElementById('name_category').selectedIndex].innerHTML;
    var data = {
        'URL': $('#URL_Category').val(),
        'Name': theContents,
    };    

    $.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->createAbsoluteUrl("categoryUrl/create"); ?>',
        data: data,
        success:function(data){
        	$( "#general-info" ).toggle(false);
            $.fn.yiiGridView.update('category_grid');
        },
        error: function(data) { // if error occured
            alert("Error occured.please try again");
            alert(data);
        },
        dataType:'html'
    }); 
}

</script>