<div class='span11' id='admin'>

	<?php 
		$this->widget(
			'bootstrap.widgets.TbButton', array(
		    'label'=>'New website',
		    'icon' => 'icon-plus-sign',
		    'url' => Yii::app()->createAbsoluteUrl("website/create"),
		    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'small', // null, 'large', 'small' or 'mini'
		)); 
	?>

	<?php $this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'website-grid',
		'type'=>'striped condensed',
		'template'=>"{summary}{items}{pager}",
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
