<legend>View Log</legend>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		'Time',
		'URL',
		'Message',
		'Code',
		'File',
		'Line',
		array(
			'name' => 'Trace',
			'type' => 'raw',
			'value' => Log::getTrace($model->Trace),
			),	
	),
)); ?>
