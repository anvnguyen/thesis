<legend>Xpath manager</legend>  
<!-- Button to show form of creating new xpath -->
<div style="text-align:left">
    <?php 
        $this->widget(
            'bootstrap.widgets.TbButton', array(
            'label'=>'New Xpath',
            'icon' => 'icon-plus-sign',
             'htmlOptions'=>array(
             		'onclick' => 'showXpathModal()',
					'class' => 'subtitle', 
             		'data-toggle' => 'collapse', 
             		'data-target' => '#general-info',
            ),
            'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
        )); 
    ?>
</div>

<div id="general-info" class="collapse in collapse-group">

<?php 
	$this->renderPartial('_form', array('model' => $model, ));
?>

</div>

<!-- Use TbGridView to show xpath -->
<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'xpath_grid',
    'type'=>'striped condensed',
    'template'=>"{items}",
    'dataProvider'=>$model->search(),
    // 'filter'=>$xpath,
    'columns'=>array(
        'ID',
        'Name',
        'Price',
        'OriginalPrice',
        'Purchases',
        'ImageURL',
        'Address',
        array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{view}{update}{delete}',
		'header'=>'Action',
		'buttons'=>array(
			'view' => array
			(
				'options'=>array(
					'ajax' => array(
                            'type' => 'POST',
                            'url' => "js:$(this).attr('href')", // ajax post will use 'url' specified above
                            'success' => 'function(data){
                                $("#try_item").html(data);
								$("#try_xpath").modal({show: true});
                            }',
                        ),
				),
			),
		),
	),
),
)); 
?>

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

<div class="form-actions">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'size' => 'small',
            'label' => 'Back',
            'htmlOptions'=>array(
                'onclick'=> "history.go(-1);"
            )
        )
    ); ?>
    <?php 
    $this->widget(
        'bootstrap.widgets.TbButton', array(
        'label'=>'Save & View',
        'icon' => 'icon-plus-sign',
        'url' => Yii::app()->createUrl('website/admin'),
        'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'small', // null, 'large', 'small' or 'mini'
    ));  
    ?>    
</div>

<script type="text/javascript">

	function tryXpath(url)
	{
		$.ajax({
			type: "POST",
			url: url,
			}).done(function( msg ) {				
				alert(msg);
		});
	}
    
    function showXpathModal()
    { 
    	$( "#general-info" ).toggle(true);
    }
</script>