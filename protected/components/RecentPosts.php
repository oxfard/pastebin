<?php

Yii::import('zii.widgets.CPortlet');

class RecentPosts extends CPortlet
{
	public $title='Последние Пасты';
	public $maxPosts=10;

	public function getRecentPosts()
	{
		return Post::model()->findAll(
				    array(
				        'condition'=>'UNIX_TIMESTAMP() < expire_time AND status = 2',
				        'order'=> 'create_time DESC',
				        'limit'=>'10',
				    ),
				    array(':s'=>'2')
				);
	}

	protected function renderContent()
	{
		$this->render('recentPosts');
	}
}