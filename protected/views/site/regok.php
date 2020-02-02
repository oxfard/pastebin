<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
 
<?php if(Yii::app()->user->hasFlash('signUp')) { ?>
 
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('signUp'); ?>
    </div>
 
<?php } ?>