<?php
$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->baseUrl; 
?>

<div class="row-fluid">
  <div class="span4 ">
	<div class="stat-block">
	  <ul>
		<li class="stat-graph inlinebar" id="weekly-visit">8,4,6,5,9,10</li>
		<li class="stat-count"><span><?php echo $numSearchs ?></span><span>Searchs</span></li>
		<li class="stat-percent">
			<span class="text-success stat-percent">
				<?php echo round($numSearchs/($numSearchs + $numViewDetails + $numBuys) * 100); ?>%
			</span>
		</li>
	  </ul>
	</div>
  </div>
  <div class="span4 ">
	<div class="stat-block">
	  <ul>
		<li class="stat-graph inlinebar" id="new-visits">2,4,9,1,5,7,6</li>
		<li class="stat-count"><span><?php echo $numViewDetails ?></span><span>View Detail</span></li>
		<li class="stat-percent">
			<span class="text-error stat-percent">
				<?php echo round($numViewDetails/($numSearchs + $numViewDetails + $numBuys) * 100); ?>%
			</span>
		</li>
	  </ul>
	</div>
  </div>
  <div class="span4 ">
	<div class="stat-block">
	  <ul>
		<li class="stat-graph inlinebar" id="unique-visits">200,300,500,200,300,500,1000</li>
		<li class="stat-count"><span><?php echo $numBuys ?></span><span>Buy</span></li>
		<li class="stat-percent">
			<span class="text-error stat-percent">
				<?php echo round($numBuys/($numSearchs + $numViewDetails + $numBuys) * 100); ?>%
			</span>
		</li>
	  </ul>
	</div>
  </div>

<div class="row-fluid">
    <div class="span8">
    	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-th-list"></span> Behaviours Chart',
			'titleCssClass'=>''
		));
		?>
        
        <?php 
        $this->Widget('ext.highcharts.HighchartsWidget', array(
		   'options'=>array(
		      'title' => array('text' => 'Behaviours statistics'),
		      'series' => array(
		         array(
		         	'type' => 'pie', 
		         	'name' => 'Percentage', 
		         	'data' => array(
		         		array('name' => 'Searchs', 'y' => round($numSearchs)),
		         		array('name' => 'View Details', 'y' => round($numViewDetails)),
		         		array('name' => 'Buys', 'y' => round($numBuys)),
		         		)
		         	),
		      )
		   )
		));
		?>
        
        <?php $this->endWidget(); ?>
    </div>
</div>         


