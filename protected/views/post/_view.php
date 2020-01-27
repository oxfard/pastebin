<div class="post">
	<div class="title">
		<?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
	</div>
	<div class="author">
		<?php echo date('F j, Y',$data->create_time); ?>
	</div>
	<div class="content">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->content;
			$this->endWidget();
		?>
	</div>
	<div class="nav">
		Posted by <?php echo $data->author->username; ?> |
		<?php if(Yii::app()->user->id == $data->author_id) {echo CHtml::link('Update', 'update'.$data->url);}; ?> |
		<?php if(Yii::app()->user->id == $data->author_id) {echo CHtml::link('Delete', 'delete'.$data->url);}; ?> |
		Last updated on <?php echo date('F j, Y',$data->update_time); ?>
	</div>
</div>
