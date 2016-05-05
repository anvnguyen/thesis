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
	        'template' => '{crawl}{view}{update}{delete}',
	        'htmlOptions'=>array('style'=>'width: 100px'),
	        'buttons' => array(
	        	'crawl' => array(
	        		'label' => 'Crawl',
	        		'icon' => 'icon-circle-arrow-down',
	        		'url' => 'Yii::app()->createUrl("website/crawl", array("id" => $data->ID))',
	        		),
	        	),
	    ),
	),
)); ?>

</div>
