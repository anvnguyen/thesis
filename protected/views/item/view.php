<legend><?php echo $model->Name; ?></legend>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Name',
		'Price',
		'Category',
		'ImageURL',
		'Update',
		'Purchases',
		'Website',
		'URL',
		'Location',
		'Address',
	),
)); ?>
