<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\base\DynamicModel;
use yii\web\ForbiddenHttpException;
use yii\web\IdentityInterface;
use app\models\User\LoginForm;

class LoginController extends Controller
{
    public $layout = 'login';

    // This action handles displaying the login form and processing the form submission
    public function actionIndex()
    {
        
        // If the user is already logged in, redirect them to the home page
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // Create a new instance of LoginForm
        $model = new LoginForm();

        // Check if form is submitted and data is valid
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // Redirect to the home page after successful login
            return $this->goBack();
        }

        // If the form is not submitted or validation fails, render the login view
        return $this->render('index', [
            'model' => $model
        ]);
    }

    // This action is used to logout the user
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
