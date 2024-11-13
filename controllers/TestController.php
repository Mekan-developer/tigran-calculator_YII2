<?php 

namespace app\controllers;

use Yii;
use app\models\Numbers;
use yii\web\Controller;

class TestController extends Controller{

    // public function actionIndex(){
    //     $this->view->title = 'Главная страница'; 
    //     return $this->render('test' );
    // }

    public function actionIndex($message = "Hello world")
    {
        $model = new Numbers();
       
        if ($model->load(Yii::$app->request->post()) && $model->saveNumbers()) {
            Yii::$app->session->setFlash('success', 'Numbers have been saved successfully.');
            return $this->refresh();  // Refresh the page after success
        }

        return $this->render('test', [
            'model' => $model,
            'message' => $message
        ]);
    }
}