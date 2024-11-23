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
class ClientDataController extends AppController
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


    public function actionEdit($id)
    {
        // Load the main client model
        $clientModel = ClientData::findOne($id);
        if (!$clientModel) {
            throw new \yii\web\NotFoundHttpException("Client not found.");
        }
    
        // Load related models
        $metalModel = MetalCalculation::findAll(['client_id' => $id]);
        $stoneModels = StoneCalculation::findAll(['client_id' => $id]);
        $workModels = WorkCalculation::findAll(['client_id' => $id]);
    
        if ($clientModel->load(Yii::$app->request->post()) && $clientModel->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try 
            {
                $clientModel->save();
    
                // Update metals
                $metalData = Yii::$app->request->post('itemsMetal', []);

                
                // Delete all previous metal calculations for this client
                MetalCalculation::deleteAll(['client_id' => $id]);
                // $this->debug($var);die('client_id');
                // Loop through the new metal data and save each one
                foreach ($metalData as $data) {
                    $data['client_id'] = $id;
                
                    $newMetalModel = new MetalCalculation();

                    // Populate the model's attributes
                    if ($newMetalModel->load(['MetalCalculation' => $data]) && $newMetalModel->save()) {
                        // Successfully saved
                    } else {
                        // Handle validation errors if necessary
                        Yii::error($newMetalModel->errors, 'MetalCalculationSave');
                    }
                }

                
    
                // Update stones
                $stonesData = Yii::$app->request->post('StoneCalculation', []);
                StoneCalculation::deleteAll(['client_id' => $id]);
          
                foreach ($stonesData as $stone) {
                    $newStoneModel = new StoneCalculation();
                    $newStoneModel->client_id = $id;
                    $newStoneModel->attributes = $stone;
                    if (!$newStoneModel->validate()) {
                        throw new \Exception('Stone validation failed: ' . json_encode($newStoneModel->errors));
                    }
                    $newStoneModel->save();
                }
            
    
                // Update works
                $workData = Yii::$app->request->post('WorkCalculation', []);
                WorkCalculation::deleteAll(['client_id' => $id]);
                foreach ($workData as $work) {
                    $newWorkModel = new WorkCalculation();
                    $newWorkModel->client_id = $id;
                    $newWorkModel->attributes = $work;
                    if (!$newWorkModel->validate()) {
                        throw new \Exception('Work validation failed: ' . json_encode($newWorkModel->errors));
                    }
                    $newWorkModel->save();
                }
        
    
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Data updated successfully!');
                return $this->redirect(['view', 'id' => $clientModel->id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Error occurred while updating data: ' . $e->getMessage());
            }
        }
        //Metal  ***************************************************************************************************************
        $metalModel = MetalCalculation::findOne(['client_id' => $id]);
        if(!empty($metalModel)){
            $itemsMetal = json_encode([$metalModel->attributes], true);
            // Decode the JSON into an associative array
            $decodedMetalModel = json_decode($itemsMetal, true);
        }else{
            $decodedMetalModel = null;
        }
       

        // stone  **************************************************************************************************************
        // Assuming $stoneModels is an array of `StoneCalculation` objects
        $stoneModels = array_map(function ($stoneModels) {
            return $stoneModels->attributes; // Extract the attributes array from each model
        }, $stoneModels);
        
        // Encode the data for Alpine.js
        // $var = json_encode($stoneModels, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);

        // Work  **************************************************************************************************************

        $workModels = array_map(function ($workModels) {
            return $workModels->attributes; // Extract the attributes array from each model
        }, $workModels);
 
        return $this->render('edit', [
            'clientModel' => $clientModel,
            'metalModel' => $decodedMetalModel,
            'stoneModelsData' => $stoneModels,
            'workModels' => $workModels,
        ]);
    }
    



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
