<div id="main_form">
<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'update_website',
        'type' => 'horizontal',
        'htmlOptions'=>array(
           'onsubmit'=>"return false;",/* Disable normal form submit */
           'onkeypress'=>" if(event.keyCode == 13){ insertCategory(); } " /* Do ajax call when user presses enter key */
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
</fieldset> 

<div class="form-actions">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'label' => 'Back',
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
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
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
        if($("#website_name").val().length == 0) {
            alert ('Name cannot be empty');
            return false;
        }else if($("#website_url").val().length == 0){
            alert ('URL cannot be empty');
            return false;
        }else{
            var url = <?php echo "'" . Yii::app()->createUrl("website/update2") . "'"; ?>;
            $.ajax({
                type: "POST",
                data: $("#update_website").serialize(),
                url: url,
            }).done(function( msg ) {
                if(msg == "success")
                    window.location.assign(<?php echo '"' . Yii::app()->createUrl('categoryurl/admin') . '"';?>)
            });
                        
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