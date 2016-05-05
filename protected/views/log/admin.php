<legend>Manage Logs</legend>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'log-grid',
	'template' => "{summary}\n{pager}\n{items}\n{pager}",
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'ID',
			'htmlOptions' => array('class' => 'span1'),
			),	
		array(
			'name' => 'Status',
			'type' => 'raw',
			'value' => 'Log::getStatus($data->Status)',
			'htmlOptions' => array('class' => 'span1'),
			),	
		'URL',
		array(
			'name' => 'Code',
			'htmlOptions' => array('class' => 'span1'),
			),
		'Message',
		'File',
		array(
			'name' => 'Line',
			'htmlOptions' => array('class' => 'span1'),
			),
		array(
			'name' => 'Time',
			'htmlOptions' => array('class' => 'span2'),
			),			
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}{delete}',
		),
	),
)); ?>
