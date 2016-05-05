
<div class='span9' id='admin'>

    <?php 
        $this->widget(
            'bootstrap.widgets.TbButton', array(
            'label'=>'New website',
            'icon' => 'icon-plus-sign',
             'htmlOptions'=>array(
                'onclick'=>'send();',
            ),
            'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
        )); 
    ?>

    <?php $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'website-grid',
        'type'=>'striped condensed',
        'template'=>"{items}",
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            'ID',
            'Name',
            'URL',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ),
        ),
    )); ?>

</div>

<script type="text/javascript">
 
function send()
{ 
    $.ajax({
        type: 'POST',
        url: '<?php echo Yii::app()->createAbsoluteUrl("website/create"); ?>',
        success:function(data){
            //TODO: update 
            $('#admin').html(data);
        },
        error: function(data) { // if error occured
            alert("Error occured.please try again");
            alert(data);
        },
        dataType:'html'
    }); 
}
 
</script>