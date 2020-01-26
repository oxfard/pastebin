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
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
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
 
        $model = new User('signUp');
 
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'sign-up-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
 
        if(isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
 
            if($model->save()) {
                $login = new UserIdentity($model->email, $model->password);
                if($login->authenticate() == '') {
                    Yii::app()->user->login($login, 0);
 
                    //Здесь можно отправить письмо пользователю о успешной регистрации
 
                    Yii::app()->user->setFlash('signUp', 'Registration successful');
                    $this->redirect(array('site/index'));
                }
 
            }
 
        }
 
        $this->render('signUp', array('model' => $model));
    }
}
