<legend>Category manager</legend>  
<div style="text-align:left">
<?php 
    $this->widget(
        'bootstrap.widgets.TbButton', array(
        'label'=>'New category URL',
        'icon' => 'icon-plus-sign',
         'htmlOptions'=>array(
            'onclick'=>'newCategory()',
         	'class' => 'subtitle',
         	'data-toggle' => 'collapse',
         	'data-target' => '#general-info',
        ),
        'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'small', // null, 'large', 'small' or 'mini'
    )); 
?>
</div>
<br>
<div id="general-info" class="collapse in collapse-group">
<?php 
	$this->renderPartial('_form', array('model' => $model, ));
?>
</div>

<!-- Use TbGridView to show category -->
<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'category_grid',
    'type'=>'striped condensed',
    'template'=>"{items}{pager}",
    'dataProvider'=>$model->search(),
    // 'filter'=>$xpath,
    'columns'=>array(
        'ID',
        'WebsiteID',
        'CategoryID',
        'URL',
        'CategoryName',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); 
?>

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
        'label'=>'Insert Xpath',
        'icon' => 'icon-plus-sign',
        'url' => Yii::app()->createUrl('xpath/admin'),
        'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'small', // null, 'large', 'small' or 'mini'
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

<script type="text/javascript">

    function newCategory()
    {
    	$( "#general-info" ).toggle(true);
    }

</script>