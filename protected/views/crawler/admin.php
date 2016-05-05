<div id='content'>
    <div class="controls controls-row">

    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'horizontalForm',
        'type'=>'horizontal',
    )); ?>
     
    <?php 
        echo CHtml::textArea('rawHtml', $RawHTML, array('class'=>'span4', 'rows'=>10)); 
    ?>
    <?php 
        echo CHtml::textArea('tidyHtml', $TidyHTML, array('class'=>'span5', 'rows'=>10)); 
    ?>

    </div>

    <br>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
    	'buttonType'=>'submit', 
    	'type'=>'btn', 
    	'icon' => 'icon-download',
    	'label'=>'Fetch URL',
    	'size' => 'small',
    	'htmlOptions'=>array(
            'data-toggle'=>'modal',
            'data-target'=>'#myModal',
        ),
    	)
    ); 
    ?>

    <?php echo CHtml::ajaxSubmitButton(
        Yii::t('Extract','Extract'),
        Yii::app()->createUrl('crawler/extractCategory'),
            array(
                // 'update'=>'#content',
                'data' => array(
                    'url' => 'js:function()
                    {
                        return document.getElementById("fetchURL").value;
                    }'
                    ),
                ),
            array(
                'id'=>'extract', 
                'class' => 'btn btn-primary',
                )
            ); 
    ?>

    <!-- Modal -->
    <?php $this->beginWidget('bootstrap.widgets.TbModal', array(
        'autoOpen' => false,
    	'id'=>'myModal', 
    	)); ?>
     
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Fetch HTML from URL</h4>
    </div>
     
    <div class="modal-body">
        <?php echo Chtml::textField('url', $url, array('id' => 'fetchURL', 'prepend'=>'URL', 'class' => 'span4')); ?>
    </div>
     
    <div class="modal-footer">
    	<?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Cancel',
            'url'=>'#',
            'size' => 'small',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>

        <?php echo CHtml::ajaxSubmitButton(
            Yii::t('fetch','Fetch'),
            Yii::app()->createUrl('crawler/admin'),
                // reload dialog when insert successfully
                array(
                    'update'=>'#content',
                    'data' => array(
                        'url' => 'js:function()
                        {
                            return document.getElementById("fetchURL").value;
                        }'
                        ),
                    ),
                array('id'=>'closeJobDialog', 
                      'class' => 'btn btn-primary')); 
        ?>             
    </div>


     
    <?php $this->endWidget(); ?>

    <?php $this->endWidget(); ?>

</div>

