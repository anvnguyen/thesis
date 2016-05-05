<legend>Category manager</legend>  

<?php 
	$this->renderPartial('_form', array('model' => $model, ));
?>

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'category_grid',
    'type'=>'striped condensed',
    'template'=>"{items}{pager}",
    'dataProvider'=>$model->search(),
    'columns'=>array(
        'ID',
        array(
            'name' => 'WebsiteID',
            'value' => 'Website::getWebsiteName($data->WebsiteID)',
        ), 
        array(
            'name' => 'CategoryID',
            'value' => 'Category::getCategoryName($data->CategoryID)',
        ), 
        array(
            'name' => 'LocationID',
            'value' => 'Location::getLocationName($data->LocationID)',
        ),    
        'URL',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
        ),
    ),
)); 
?>

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
        'label'=>'Insert Xpath',
        'icon' => 'icon-plus-sign',
        'url' => Yii::app()->createUrl('xpath/admin'),
        'type'=>'primary', 
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

