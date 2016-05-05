<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'response_feedback_form',
 'htmlOptions' => array(
	    'enctype' => 'multipart/form-data',  
	    'onsubmit'=>"return false;",/* Disable normal form submit */
	   	'onkeypress'=>" if(event.keyCode == 13){ sendResponse(); } " /* Do ajax call when user presses enter key */          
	),
)); 
?>
<div class="row-fluid">
<div class="span6">
	<?php echo $form->textFieldRow($feedback, 'ID', array('class'=>'span3', 'style' => 'display:none;')); ?>
	<?php echo $form->textFieldRow($feedback, 'name', array('class'=>'span12', 'readonly' => true)); ?>
	<?php echo $form->textFieldRow($feedback, 'email', array('class'=>'span12', 'readonly' => true)); ?>
	<?php echo $form->textAreaRow($feedback, 'message', array('class'=>'span12', 'rows'=>5, 'readonly' => true)); ?>
	<?php echo $form->textFieldRow($feedback, 'date', array('class'=>'span12', 'readonly' => true)); ?>
</div>
<div class="span6">
	<?php echo $form->textAreaRow($feedback, 'response', array('class'=>'span12', 'rows'=>5, 'readonly' => false)); ?>
	<div id="message_response"></div>
	<button type="submit" class="btn btn-success" onclick="sendResponse()">Reply</button>
	<button type="submit" class="btn btn-default" onclick="cancel()">Cancel</button>
</div>
</div>
  <?php $this->endWidget(); ?>

<script type="text/javascript">
	
function sendResponse(){
  	$.ajax({
	   	type: 'POST',
	    url: <?php echo '"' . Yii::app()->createUrl('feedback/reply') . '"'; ?>,
	   	data: $("#response_feedback_form").serialize(),
		success:function(data)
		{	
			if(data=='success'){
				$("#message_response").append("<div class='alert alert-success'>" + 
	             "<button type='button' class='close' data-dismiss='alert'>&times;</button>" + 
	             "<strong>Send response success!</strong></span>" +
	           "</div>");
		    }else{
		    	$("#message_response").append("<div class='alert alert-error'>" + 
	             "<button type='button' class='close' data-dismiss='alert'>&times;</button>" + 
	             "<strong>" + 
	             data + 
	             "</strong></span>" +
	           "</div>");
		    }
		},
		error: function(data) 
		{ 
	        $("#message_response").append("<div class='alert alert-error'>" + 
             "<button type='button' class='close' data-dismiss='alert'>&times;</button>" + 
             "<strong>" + 
             data + 
             "</strong></span>" +
           "</div>");
		},
 	});
}

function cancel(){
	window.location = <?php echo '"' . Yii::app()->createUrl('feedback/admin') . '"'; ?>;
	return;
}

</script>