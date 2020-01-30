<?php if(Yii::app()->user->hasFlash('signUp')) { ?>
 
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('signUp'); ?>
    </div>
 
<?php } ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
)); ?>
