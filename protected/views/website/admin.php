<div class='span12' id='admin'>

<?php 
$this->widget(
	'bootstrap.widgets.TbButton', array(
    'label'=>'New website',
    'icon' => 'icon-plus-sign',
    'url' => Yii::app()->createAbsoluteUrl("website/create"),
    'type'=>'primary', 
)); 
?>

<br>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'website-grid',
	'type'=>'striped condensed',
	'template'=>"{summary}{items}{pager}",
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'ID',
			'htmlOptions' => array('class' => 'span1'),
			),
		'Name',
		'URL',
		'LastCrawl',
		array(
	        'class'=>'bootstrap.widgets.TbButtonColumn',
	        'htmlOptions'=>array('style'=>'width: 50px'),
	    ),
	),
)); ?>

</div>
