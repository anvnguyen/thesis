<div id="main_form">
<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'horizontalForm',
        'type' => 'horizontal',
        'htmlOptions'=>array(
           'onsubmit'=>"return false;",/* Disable normal form submit */
           'onkeypress'=>" if(event.keyCode == 13){ getHTML(); } " /* Do ajax call when user presses enter key */
         ),
    )
); 
?> 
<fieldset> 
    <legend>New website</legend>
    <!-- Webisite name --> 
    <?php 
        echo $form->textFieldRow(
            $model,
            'Name',
            array(
                'class' => 'span3',
                // 'prepend' => 'Name',
                'id' => 'website_name',
            )
        );
    ?> 
    <!-- Website URL -->
    <?php 
        echo $form->textFieldRow(
            $model,
            'URL',
            array(
                'class' => 'span5',
                // 'prepend' => 'URL',
                'id' => 'website_url',
            )
        );
    ?>

    <?php 
        echo $form->dropDownListRow(
            $model, 
            'LocationID', 
            Location::getLocations(),
            array(
                'class'=>'span2',
				'id' => 'website_location',
            )
        ); 
    ?>

    <div class="controls">
    <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit', 
            'type'=>'btn', 
            'icon' => 'icon-plus-sign',
            'label'=>'Add new location',
            'size' => 'small',
            'htmlOptions'=>array(
                'onclick'=>'addLocation();',
            ),
        ));
    ?>
    </div> 

    <br>   

    <div class="controls">
        <!-- Button to get repaired HTML -->
        <?php 
            $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit', 
                    'type'=>'btn', 
                    'icon' => 'icon-download',
                    'label'=>'Get HTML',
                    'size' => 'small',
                    'htmlOptions'=>array(
                        'onclick'=>'getHTML();',
                    ),
                )
            ); 
        ?>
    </div>
    <br>
    <!-- text area to contain raw HTML -->
    <?php 
        echo $form->textAreaRow($model, 'RawHTML', array('class'=>'span10', 'rows'=>8, 'id' => 'textarea_rawHTML')); 
    ?>

    <div style="text-align:right">
        <?php 
            $this->widget(
                'bootstrap.widgets.TbButton', array(
                'label'=>'View in browser',
                'icon' => 'icon-eye-open',
                 'htmlOptions'=>array(
                    'onclick'=>'viewRawHTML();',
                ),
                'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'small', // null, 'large', 'small' or 'mini'
            )); 
        ?>
    </div>          

    <br>
    <!-- text area to contain repaired HTML -->
    <?php 
        echo $form->textAreaRow($model, 'TidyHTML', array('class'=>'span10', 'rows'=>8, 'id' => 'textarea_repairedHTML')); 
    ?>

    <div style="text-align:right">
        <?php 
            $this->widget(
                'bootstrap.widgets.TbButton', array(
                'label'=>'View in browser',
                'icon' => 'icon-eye-open',
                 'htmlOptions'=>array(
                    'onclick'=>'viewRepairedHTML();',
                ),
                'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'small', // null, 'large', 'small' or 'mini'
            )); 
        ?>
    </div> 
</fieldset> 

<div class="form-actions">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'label' => 'Back',
            'size' => 'small',
            'htmlOptions'=>array(
                'onclick'=> "history.go(-1);"
            )
        )
    ); ?>
    <?php 
    $this->widget(
        'bootstrap.widgets.TbButton', array(
        'label'=>'Insert Category',
        'icon' => 'icon-plus-sign',
         'htmlOptions'=>array(
            'onclick'=>'insertCategory();',
        ),
        'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'small', // null, 'large', 'small' or 'mini'
    ));  
    ?>    
</div>

<?php
$this->endWidget();
unset($form);
?>
</div>    <!-- close main form --> 

<!-- Modal to show new category form -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'location_modal')); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>New location</h4>
    </div>
     
    <div class="modal-body">
        <div id="new_location"></div>
    </div>
 
<?php $this->endWidget(); ?>


<script type="text/javascript">

    function addLocation()
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("location/create"); ?>',
            success:function(data){
                //TODO: update 
                $('#new_location').html(data);
                //TODO: toggle the modal
                $('#location_modal').modal({show: true});
            },
            error: function(data) { // if error occured
                alert("Error occured.please try again");
                alert(data);
            },
            dataType:'html'
        }); 
    }

    function viewRawHTML()
    {
        myWindow=window.open('', '_blank')
        myWindow.document.write($('#textarea_rawHTML').val());
    }

    function viewRepairedHTML()
    {
        myWindow=window.open('', '_blank')
        myWindow.document.write($('#textarea_repairedHTML').val());
    }

    function insertCategory()
    {
        var name = $("#website_name").val();
        var url = $("#website_url").val();
        var rawHTML = $("#textarea_rawHTML").val();
        var tidyHTML = $("#textarea_repairedHTML").val();

        if(name.length == 0) {
            alert ('Name cannot be empty');
            return false;
        }else if(url.length == 0){
            alert ('URL cannot be empty');
            return false;
        }else if(rawHTML.length == 0 || tidyHTML.length == 0){
            alert('Please get HTML of URL');
        }
        else {

            window.location.assign(<?php echo '"' . Yii::app()->createUrl('categoryUrl/admin') . '"';?>)            
        }        
    }

    function getHTML()
    {
        var data = new Array();
        data[0] = $("#website_name").val();
        data[1] = $("#website_url").val();
        data[2] = document.getElementById('website_location').options[document.getElementById('website_location').selectedIndex].text;

        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("crawler/getTidyHTML"); ?>',
            data: { Website : data },
            success:function(response){
                var tidyHTML = jQuery.parseJSON(response);
                $('#textarea_repairedHTML').val(tidyHTML.TidyHTML);
                $('#textarea_rawHTML').val(tidyHTML.RawHTML);
            },
            error: function(data) { // if error occured
                alert("Error occured.please try again");
                alert(data);
            },
            dataType:'html'
        });
    }
</script>