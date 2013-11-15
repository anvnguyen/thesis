<?php
$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->baseUrl; 
?>

<div class="page-header">
  <h1>Users <small>Account management</small></h1>
</div>

<div class="row-fluid">
  <div class="span8">
  	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"User account",
		));
		
	?>
  	<?php $this->widget('zii.widgets.grid.CGridView', array(
			/*'type'=>'striped bordered condensed',*/
			'itemsCssClass'=>'table table-hover',
			'dataProvider'=>$model->search(),
			'template'=>"{items}",
			'columns'=>array(
				array('name'=>'id', 'header'=>'#'),
				array('name'=>'username', 'header'=>'User name'),
				array('name'=>'password', 'header'=>'Password'),
				array('name'=>'email', 'header'=>'Email', 'type'=>'raw'),
				
			),
		)); ?>
<?php $this->endWidget();?>
  </div>