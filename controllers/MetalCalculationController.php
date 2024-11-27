<?php

namespace app\controllers;

use Yii;
use app\models\MetalCalculation;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MetalCalculationController implements the CRUD actions for MetalCalculation model.
 */
class MetalCalculationController extends AppController
{
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
                            'actions' => ['index','create','view','edit'],
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

    /**
     * Lists all MetalCalculation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => MetalCalculation::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MetalCalculation model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MetalCalculation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

     public function actionCreate($client_id)
     {
         $model = new MetalCalculation();
         $model->client_id = $client_id;
 
         if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['stone-calculation/create', 'client_id' => $client_id]);
         }
 
         return $this->render('create', [
             'model' => $model,
         ]);
     }

    // public function actionCreate()
    // {
    //     $model = new MetalCalculation();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing MetalCalculation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MetalCalculation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MetalCalculation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MetalCalculation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MetalCalculation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
