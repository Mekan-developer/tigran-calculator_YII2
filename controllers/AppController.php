<?php 

namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class AppController extends Controller{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['delete'],
                            'roles' => ['admin'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['index','view','edit'],
                            'roles' => ['admin','manager'],
                            'allow' => true,
                        ]
                    ],
                    'denyCallback' => function ($rule, $action) {
                        if(Yii::$app->user->isGuest){
                            return Yii::$app->response->redirect(['login']);
                        }
                        // elseif (Yii::$app->user->identity->username === 'user') {
                        //     return Yii::$app->response->redirect(['calculation-base']);
                        // }
                        throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page.');
                    },

                ],
            ]
        );
    }

    public function debug($arr){

        echo '<pre>' . print_r($arr, true) . '</pre>';

    }

}

