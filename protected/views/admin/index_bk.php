<div class="span2" id ="side-menu">

<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Crawler'),
        array('label'=>'Website', 'icon'=>'home', 'url' => '#', 
        	'itemOptions'=>array('onclick'=>'getPartialView("website")') ,'active'=>true),
        array('label'=>'Category', 'icon'=>'book','url' => '#',
        	'itemOptions'=>array('onclick'=>'getPartialView("category")'),),
        array('label'=>'Products', 'icon'=>'pencil','url' => '#',
        	'itemOptions'=>array('onclick'=>'getPartialView("product")')),
        array('label'=>'User management', ),
        array('label'=>'Profile', 'icon'=>'user', 'url' => '#',
        	'itemOptions'=>array('onclick'=>'getPartialView("profile")') ),
        array('label'=>'Settings', 'icon'=>'cog', 'url' => '#',
        	'itemOptions'=>array('onclick'=>'getPartialView("pettings")') ),
        array('label'=>'Help', 'icon'=>'flag', 'url' => '#',
        	'itemOptions'=>array('onclick'=>'getPartialView("pelp")') ),
    ),
)); ?>

</div>

<br>
<div class="span9 well-right" id="main-content">
</div>

<script type="text/javascript">
function getPartialView(item)
{
	var url =  <?php echo "\"".Yii::app()->createUrl('admin')."\"" ?>  + "/getPartialView";
	$.ajax({
			type: "POST",
			data:{
				'page': item,
			},
			url: url,
	}).done(function( msg ) {
		if(msg == "false"){
			console.log("Can not retrieve data");
		}
		else{
			$('#main-content').html(msg);
		}
	});
}
</script>
