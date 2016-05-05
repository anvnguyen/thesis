<div class="page-header">
  <h1>Users <small>Account management</small></h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		array('name'=>'ID', 'header'=>'#'),
		array('name'=>'username', 'header'=>'User name'),
		array('name'=>'email', 'header'=>'Email'),
		array('name'=>'role', 'header'=>'Role'),
		array('name'=>'subscribe', 'header'=>'Subscribe'),
		array('name'=>'lasttimeLogin', 'header'=>'Last login'),	
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
        ),			
	),
)); ?>