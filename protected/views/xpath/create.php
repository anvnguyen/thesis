<legend>Xpath manager</legend> 

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'xpath_form',
    // 'type'=>'vertical',
    'type'=>'inline',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->textFieldRow($model, 'URL', array('id' => 'URL_Xpath', 'class' => 'span6')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'View Tidy HTML', 
            'htmlOptions' => array('onclick' => 'viewTidyHTML()')            
        ));?>

<br>
<br>
<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', 
    'label'=>'Try', 
	'htmlOptions'=> array('onclick'=>'tryXpath($("#Name_Xpath").val())'))); 
echo ' ';
?>
<?php echo $form->textFieldRow($model, 'Name', array(
    'prepend'=>'Name', 
    'id' => 'Name_Xpath', 
    'style' => "width:300%")); ?>

<br> 
<br>
<?php $this->widget('bootstrap.widgets.TbButton', 
    array(
        'type'=>'primary', 
        'label'=>'Try', 
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Price_Xpath").val())'))); 
        echo ' ';
?>
<?php echo $form->textFieldRow($model, 'Price', 
    array(
        'style' => "width:300%", 
        'prepend'=>'Price',
		'id' => 'Price_Xpath')); ?> 
<br>
<br>   
<?php $this->widget('bootstrap.widgets.TbButton', 
    array(
        'type'=>'primary', 
        'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Original_Price_Xpath").val())'))); 
    echo ' ';
?>		
<?php echo $form->textFieldRow($model, 'OriginalPrice', 
    array(
        'style' => "width:300%",
        'prepend'=>'Original Price',
		'id' => 'Original_Price_Xpath',)); ?>
<br> 
<br>   
<?php $this->widget('bootstrap.widgets.TbButton', 
    array(
        'type'=>'primary', 
        'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Address_Xpath").val())'))); 
    echo ' ';?>
<?php echo $form->textFieldRow($model, 'Address', 
    array(
        'style' => "width:300%", 
        'prepend'=>'Address',
		'id' => 'Address_Xpath',)); ?> 
<br>   
<br> 
 
<?php $this->widget('bootstrap.widgets.TbButton', 
    array(
        'type'=>'primary', 
        'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Purchases_Xpath").val())'))); 
    echo ' ';
?>
<?php echo $form->textFieldRow($model, 'Purchases', 
    array(
        'style' => "width:300%", 
        'prepend'=>'Purchases',
		'id' => 'Purchases_Xpath',)); ?> 
<br> 
<br> 
<?php $this->widget('bootstrap.widgets.TbButton', 
    array(
        'type'=>'primary', 
        'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#ImageURL_Xpath").val())'))); 
    echo ' ';
?>
<?php echo $form->textFieldRow($model, 'ImageURL', 
    array(
        'style' => "width:300%",
        'prepend'=>'Image URL',
		'id' => 'ImageURL_Xpath',));  ?> 
<br>
<br>  
<?php $this->widget('bootstrap.widgets.TbButton', 
    array(
        'type'=>'primary', 
        'label'=>'Try',
        'htmlOptions'=> array('onclick'=>'tryXpath($("#Description_Xpath").val())'))); echo ' ';?>
<?php echo $form->textFieldRow($model, 'Description', 
    array(
        'style' => "width:300%", 
        'prepend'=>'Desciption',
        'id' => 'Description_Xpath',));  ?>
<br>
<br>
<?php $this->widget('bootstrap.widgets.TbButton', 
    array(
        'type'=>'primary', 
        'label'=>'Try',
		'htmlOptions'=> array('onclick'=>'tryXpath($("#Condition_Xpath").val())'))); echo ' ';?>
<?php echo $form->textFieldRow($model, 'Condition', 
    array(
        'style' => "width:300%", 
        'prepend'=>'Condition',
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

function tryXpath($xpath)
{
	var data = {
        'xpath': $xpath,
        'URL': $('#URL_Xpath').val(),
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
    $.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->createAbsoluteUrl("xpath/create"); ?>',
        data: $("#xpath_form").serialize(),
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

function viewTidyHTML()
{
    var url =  <?php echo "\"".Yii::app()->createUrl('xpath/viewTidyHTML')."\"" ?>  + "&url=" + $("#URL_Xpath").val();
    window.open(url); 
}


</script>
