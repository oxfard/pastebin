<?php

class SiteController extends Controller
{
	public $layout='column1';

	/**
	 * Declares class-based actions.
	 */

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{

		// Если Вк авторизация
		if(isset($_GET['hash']))
		{	

			if(md5('7304069'.$_GET['uid'].'m6tRzoG1PcjEGu0MIyNZ') == $_GET['hash'])
			{
				$ident = new UserIdentity($_GET['uid'], $_GET['hash']);
                if($ident->authenticate())
                {
                    Yii::app()->user->login($ident);
                    Yii::app()->user->setFlash('signUp', 'Логин прошел успешно!!!');
                    $this->redirect(array('post/index'));
                }
                else
                {
                	$this->actionSignUp();
                }
			}
			else 
			{
				echo "Fail. Hack attempt!!!"
			;}
		}

		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		// Вывод формы авторизации
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionSignUp()
    {
        if (!Yii::app()->user->isGuest)
            throw new CHttpException(404, 'Error 404');
 
        $model = new User();
 
        if(isset($_POST['User'])) 
        {
            $model->attributes = $_POST['User'];
 
            if($model->save())
            {
                $ident = new UserIdentity($model->username, $_POST['User']['password']);
                if($ident->authenticate())
                {
                    Yii::app()->user->login($ident);
                    Yii::app()->user->setFlash('signUp', 'Регистрация выполнена успешна. Автологин прошел успешно!!!');
                    $this->redirect(array('post/index'));
                }
 
            }
 
        }

        if(isset($_GET['hash'])) 
        {
        	$model->username = $_GET['uid'];
        	$model->password = $_GET['hash'];
        	if($model->save())
            {
            	# Авторизуем
            	$ident = new UserIdentity($model->username, $_GET['hash']);
            	if($ident->authenticate())
                {
                    Yii::app()->user->login($ident);
                    Yii::app()->user->setFlash('signUp', 'Регистрация выполнена успешна. Автологин прошел успешно!!!');
                    $this->redirect(array('post/index'));
                }
                else 
                {
                	var_dump('Неудачная идентификация');
                }
            }
        }
 
        $this->render('signUp', array('model' => $model));
    }
}
