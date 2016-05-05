<?php
/* @var $this XpathController */
/* @var $model Xpath */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'xpath-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

        <?php 
        echo $form->textFieldRow(
            $model,
            'Name',
            array(
                'class' => 'span4', 
                'id' => 'Name_Xpath',
                'style' => 'text-align: left',
            )
        );
        ?>        

        <?php 
        echo $form->textFieldRow(
            $model,
            'Price',
            array(
                'class' => 'span4', 
                'id' => 'Price_Xpath',
            )
        );
        ?>        

        <?php 
        echo $form->textFieldRow(
            $model,
            'OriginalPrice',
            array(
                'class' => 'span4', 
                'id' => 'Original_Price_Xpath',
            )
        );
        ?>        

        <?php 
        // echo $form->textFieldRow(
        //     $model,
        //     'ExpiredDate',
        //     array(
        //     	'class' => 'span4', 
        //         'id' => 'ExpireDate_Xpath',
        //     )
        // );
        ?>

        <?php 
        echo $form->textFieldRow(
            $model,
            'Address',
            array(
                'class' => 'span4', 
                'id' => 'Address_Xpath',
            )
        );
        ?>      

        <?php 
        echo $form->textFieldRow(
            $model,
            'Purchases',
            array(
            	'class' => 'span4', 
                'id' => 'Purchases_Xpath',
            )
        );
        ?>        

        <?php 
        echo $form->textFieldRow(
            $model,
            'ImageURL',
            array(
            	'class' => 'span4', 
                'id' => 'ImageURL_Xpath',
            )
        );
        ?> 





<div class="modal-footer" id="modal_footer">
    <?php 
    $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Create',
        'htmlOptions'=>array(
            'onclick'=>'createXpath();',
            'data-dismiss'=>'modal'
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

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
function allFine(data) {
                // refresh grid
                $.fn.yiiGridView.update('xpath_grid');
        }

function dismiss_form()
{
	$( "#general-info" ).toggle(false);
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
