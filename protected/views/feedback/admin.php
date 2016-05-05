<legend>Manage Feedbacks</legend>
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"Feedbacks",
	));
?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'feedback-grid',
	'dataProvider'=>$model->search(),
	'template' => "{summary}\n{pager}\n{items}\n{pager}",
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'status', 'header'=>'Status', 'htmlOptions' => array('class' => 'span1'), 
			'value' => 'Feedback::getStatus($data->status)',
		 	'type'  => 'raw',
		),
		array('name'=>'name', 'header'=>'Name', 'type'  => 'raw',
		),
		'email',
		'message',	
		'response',	
		'date',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}{delete}',
		),
	),
)); ?>

<?php $this->endWidget();?>
