<legend>Xpath manager</legend> 

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'xpath_form',
    'type'=>'inline',
	'enableAjaxValidation'=>false,
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'size'=>'normal', 'label'=>'Try', 
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Name_Xpath").val())'))); echo ' ';?>
<?php echo $form->textFieldRow($model, 'Name', array('class' => 'span8 input-medium', 'prepend'=>'Name',
		'id' => 'Name_Xpath')); ?>

<br> 
<br>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'size'=>'normal', 'label'=>'Try', 
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Price_Xpath").val())'))); echo ' ';?>
<?php echo $form->textFieldRow($model, 'Price', array('class' => 'span8 input-medium', 'prepend'=>'Price',
		'id' => 'Price_Xpath')); ?> 
<br>
<br>   
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'size'=>'normal', 'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Original_Price_Xpath").val())'))); echo ' ';?>		
<?php echo $form->textFieldRow($model, 'OriginalPrice', array('class' => 'span8 input-medium', 'prepend'=>'Original Price',
		'id' => 'Original_Price_Xpath',)); ?>
<br> 
<br>   
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'size'=>'normal', 'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Address_Xpath").val())'))); echo ' ';?>
<?php echo $form->textFieldRow( $model, 'Address', array('class' => 'span8 input-medium', 'prepend'=>'Address',
		'id' => 'Address_Xpath',)); ?> 
<br>   
<br> 
 
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'size'=>'normal', 'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Purchases_Xpath").val())'))); echo ' ';?>
<?php echo $form->textFieldRow($model, 'Purchases', array('class' => 'span8 input-medium', 'prepend'=>'Purchases',
		'id' => 'Purchases_Xpath',)); ?> 
<br> 
<br> 
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'size'=>'normal', 'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#ImageURL_Xpath").val())'))); echo ' ';?>
<?php echo $form->textFieldRow($model, 'ImageURL', array('class' => 'span8 input-medium', 'prepend'=>'Image URL',
		'id' => 'ImageURL_Xpath',));  ?> 
<br>
<br>  
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'size'=>'normal', 'label'=>'Try',
        'htmlOptions'=> array('onclick'=>'tryXpath($("#Description_Xpath").val())'))); echo ' ';?>
<?php echo $form->textFieldRow($model, 'Description', array('class' => 'span8 input-medium', 'prepend'=>'Desciption',
        'id' => 'Description_Xpath',));  ?>
<br>
<br>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'size'=>'normal', 'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Condition_Xpath").val())'))); echo ' ';?>
<?php echo $form->textFieldRow($model, 'Condition', array('class' => 'span8 input-medium', 'prepend'=>'Condition',
		'id' => 'Condition_Xpath',));  ?>
<br>
<br>

<?php $this->endWidget(); ?>
            
<div class="modal-footer" id="modal_footer">
<div style="text-align:left">
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Try all',
        'htmlOptions'=>array(
            'onclick'=>'tryAll();',			
            ),
    )); 
    ?>
</div>
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Save',
        'htmlOptions'=>array(
            'onclick'=>'createXpath();',
            ),
    )); 
    ?>
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cancel',
        'htmlOptions'=>array(
			'onclick' => 'dismiss_form()',
		),
    )); 
    ?>
</div>

</div><!-- form -->

<!-- Modal to show new product Xpath -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', 
    array(
    'id'=>'try_xpath',
    'htmlOptions' => array('style' => 'width: 650px;'),
    )
    ); ?> 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Try Xpath</h4>
    </div>
     
    <div class="modal-body">
        <div id="try_item"></div>
    </div> 
<?php $this->endWidget(); ?>

<script>  

function tryAll()
{
	$.ajax({
        type: "POST",
        url: <?php echo '"' .Yii::app()->createUrl("xpath/tryAll"). '"'; ?>,
        data: $("#xpath_form").serialize(),
    }).done(function( msg ) {
        $("#try_item").html(msg);
		$("#try_xpath").modal({show: true});
    });
}

function dismiss_form()
{
	
}

function tryXpath($xpath)
{
	var data = {
        'xpath': $xpath,
    };    

    $.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->createAbsoluteUrl("xpath/tryXpath"); ?>',
        data: data,
        success:function(data){
            alert(data);
        },
        error: function(data) { // if error occured
            alert("Error occured.please try again");
            alert(data);
        },
        dataType:'html'
    });
}
    
function createXpath()
{
    var data = {
        'Name': $('#Name_Xpath').val(),
        'Price': $('#Price_Xpath').val(),
        'Address': $('#Address_Xpath').val(),
        'Purchases': $('#Purchases_Xpath').val(),
        'ImageURL': $('#ImageURL_Xpath').val(),
    };    

    $.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->createAbsoluteUrl("xpath/create"); ?>',
        data: data,
        success:function(data){
            //collapse this form
            $( "#general-info" ).toggle(false);
            $.fn.yiiGridView.update('xpath_grid');
        },
        error: function(data) { // if error occured
            alert("Error occured.please try again");
            alert(data);
        },
        dataType:'html'
    }); 
}

</script>
