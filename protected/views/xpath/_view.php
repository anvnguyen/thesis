<!-- <div class="row-fluid"> -->
	<div class="span12">
		<div class="span4">
			<div class="logowrapper">
				<img class="logoicon" src=<?php echo '"' . $item->ImageURL . '"'; ?> alt="Product Image"/>
			</div>
		</div>
		<div class="span8">
			<form class="form-horizontal">
				<?php
					//Name
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Name',
					));					
					echo '<p>';
					echo $item->Name? $item->Name : "NULL";
					echo '</p>';	

					//Price
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Price',
					));
					echo '<p>';
					echo $item->Price? $item->Price : "NULL";
					echo '</p>';

					//Original Price
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Original Price',
					));
					echo '<p>';
					echo $item->OriginalPrice? $item->OriginalPrice : "NULL";
					echo '</p>';
					
					//Purchase 
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
							'label'=>'Purchases',
					));
					echo '<p>';
					echo $item->Purchases? $item->Purchases : "NULL";
					echo '</p>';
					
					//Address
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', 
							'label'=>'Address:',
					));
					echo '<p>';
					echo $item->Address? $item->Address : "NULL";
					echo '</p>';

					//Description
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', 
							'label'=>'Description:',
					));
					echo '<p>';
					echo $item->Description? $item->Description : "NULL";
					echo '</p>';

					//Condition
					$this->widget('bootstrap.widgets.TbLabel', array(
							'type'=>'success', 
							'label'=>'Condition:',
					));
					echo '<p>';
					echo $item->Condition? $item->Condition : "NULL";
					echo '</p>';
					?>
			</form>
		</div>
	</div>