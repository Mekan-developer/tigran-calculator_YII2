<?php

namespace app\controllers;

use app\models\MetalCalculation;
use app\models\StoneCalculation;
use app\models\WorkCalculation;
use Yii;
use app\models\ClientData;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientDataController implements the CRUD actions for ClientData model.
 */
class ClientDataController extends Controller
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
            ]
        );
    }

    /**
     * Lists all ClientData models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ClientData::find(),
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
     * Displays a single ClientData model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    public function actionView($id)
{
    // Fetch client data
    $clientModel = ClientData::findOne($id);

    // Fetch related data
    $metalModel = MetalCalculation::findOne(['client_id' => $id]);
    $stoneModels = StoneCalculation::findAll(['client_id' => $id]);
    $workModels = WorkCalculation::findAll(['client_id' => $id]);

    if (!$clientModel) {
        throw new NotFoundHttpException('Client not found.');
    }

    // Render the data in a detailed view
    return $this->render('view', [
        'clientModel' => $clientModel,
        'metalModel' => $metalModel,
        'stoneModels' => $stoneModels,
        'workModels' => $workModels,
    ]);
}


    /**
     * Creates a new ClientData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

     public function actionCreate()
     {
         $model = new ClientData();
 
         if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['metal-calculation/create', 'client_id' => $model->id]);
         }
 
         return $this->render('create', [
             'model' => $model,
         ]);
     }
    // public function actionCreate()
    // {
    //     $model = new ClientData();

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
     * Updates an existing ClientData model.
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
     * Deletes an existing ClientData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->request->validateCsrfToken(); // Ensure CSRF token validation
        $model = ClientData::findOne($id);

        if ($model !== null) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Данные клиента успешно удалены.');
        } else {
            Yii::$app->session->setFlash('error', 'Данные клиента не найдены.');
        }

        return $this->redirect(['index']);
    }


    /**
     * Finds the ClientData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ClientData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientData::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
