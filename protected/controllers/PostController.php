<?php

class PostController extends Controller
{
	public $layout='column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{ 
		return array(
			
			array('allow',  // allow all users to access 'index','view','create' actions.
				'actions'=>array('index','view','create'),
				'users'=>array('*'),
			),
			/*
			array('allow',
				'actions'=>array('admin'),
				'users'=>array('@'),
			),
			*/
			array('allow',  // allow all users to access 'update' actions.
				'actions'=>array('update','delete'),
				'expression' => array('PostController','allowOnlyOwner'),
				
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}
	public function allowOnlyOwner()
	{
            $post = Post::model()->findByPk($_GET["id"]);
            return ($post->author_id == Yii::app()->user->id); #and (time() < $post->expire_time) ;
    }

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$post=$this->loadModel();

		#if(UNIX_TIMESTAMP() < $post->expire_time){ 
			$this->render('view',array(
				'model'=>$post,
			));
		#}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Post;
		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(!Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			/*
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
			*/

			$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria(array(
			
			'condition'=>'UNIX_TIMESTAMP() < expire_time AND status = 2',
			'order'=>'update_time DESC',
			
		));

		$dataProvider=new CActiveDataProvider('Post', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['postsPerPage'],
			),
			'criteria'=>$criteria,
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				if(Yii::app()->user->isGuest)
					
					$condition='expire_time > UNIX_TIMESTAMP()';
				else
					$condition='expire_time > UNIX_TIMESTAMP()';
				$this->_model=Post::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	
}
