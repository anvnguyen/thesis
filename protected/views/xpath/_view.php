<div class="row-fluid">
	<div class="span8">
		<div class="span4">
			<div class="logowrapper">
				<img class="logoicon" src=<?php echo '"' . $item->ImageURL . '"'; ?> alt="App Logo"/>
			</div>
		</div>
		<div class="span4">
			<form class="form-horizontal">
				<?php
					//Name
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Name',
					));
					echo '<br>'; 
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>$item->Name,
					)); 
					echo '<br>';
					echo '<br>';
					
					//Price
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Price',
					));
					echo '<br>';
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>$item->Price,
					));
					echo '<br>';
					echo '<br>';
					
					//Original Price
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Original Price',
					));
					echo '<br>';
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>$item->OriginalPrice,
					));
					echo '<br>';
					echo '<br>';
					
					//Expired date
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Expired Date',
					));
					echo '<br>';
					// $this->widget('bootstrap.widgets.TbLabel', array(
					// 		'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
					// 		'label'=>$item->ExpiredDate,
					// ));
					echo '<br>';
					echo '<br>';
					
					//Purchase 
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Purchases',
					));
					echo '<br>';
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>$item->Purchases,
					));
					echo '<br>';
					echo '<br>';
					
					//Address
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Address:',
					));
					echo '<br>';
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>$item->Address,
					));
				?>
			</form>
		</div>
	</div>
</div>