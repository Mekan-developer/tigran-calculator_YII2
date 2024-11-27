<?php 

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\ClientData;
use app\models\MetalCalculation;
use app\models\StoneCalculation;
use app\models\WorkCalculation;
use yii\filters\VerbFilter;

class CalculatorController extends AppController
{

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
                            'actions' => ['index'],
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


    public function actionIndex()
    {
        $clientModel = new ClientData();
        $metalModel = [new MetalCalculation()];
        $stoneModels = [new StoneCalculation()]; // Initialize with one empty model
        $workModels = [new WorkCalculation()];
       
        if ($clientModel->load(Yii::$app->request->post()) && $clientModel->validate()) {
            $transaction = Yii::$app->db->beginTransaction(); // Start transaction
            try {
                $ClientSize = Yii::$app->request->post('ClientSize');
                $ClientSize = json_decode($ClientSize, true);

                for ($i=0; $i < count($ClientSize)+1; $i++) { 
                    $newModel = clone $clientModel; // Clone the model to create a new instance
                    $newModel->isNewRecord = true; // Mark it as a new record
                    $newModel->id = null;         // Reset the primary key (if 'id' is the PK field)

                    if ($newModel->save()) {
                        $metalData = Yii::$app->request->post('itemsMetal');
                        if ($metalData) {
                            $metalItems = json_decode($metalData, true);
                           
                            // foreach ($metalItems as $item) {
                                $metalModel = new MetalCalculation();
                                $metalModel->client_id = $newModel->id;
                                $metalModel->attributes = $metalItems[$i];

                                if ($metalModel->validate()) {
                                    $metalModel->save();
                                } else {
                                    Yii::$app->session->setFlash('error', 'Validation failed for one or more items.');
                                }
                            // }
    
                            // Process Stone data ************************************************************
                            $stonesData = Yii::$app->request->post('StoneCalculation', []);
                            $stoneModels = [];
                            foreach ($stonesData[$i] as $stone) {
                                $stoneModel = new StoneCalculation();
                                $stoneModel->client_id = $newModel->id;
                                $stoneModel->attributes = $stone;
    
                                if ($stoneModel->validate()) {
                                    $stoneModel->save();
                                    $stoneModels[] = $stoneModel;
                                } else {
                                    throw new \Exception('Validation failed for Stone model: ' . json_encode($stoneModel->errors));
                                }
                            }
    
                            // Process Work data ****************************************************
                            $workData = Yii::$app->request->post('WorkCalculation', []);
           
                            $workModels = [];
    
                            $errors = [];
                            foreach ($workData[$i] as $work) {
                                $workModel = new WorkCalculation();
                                $workModel->client_id = $newModel->id;
                                $workModel->attributes = $work;

                                if ($workModel->validate()) {
                                    $workModel->save();
                                    $workModels[] = $workModel;
                                } else {
                                    $errors[] = $workModel->errors;
                                }
                            }

                            if (!empty($errors)) {
                                Yii::$app->session->setFlash('error', 'Some models failed validation: ' . json_encode($errors));
                            }

    
                        }
                    }
                }
                 // Commit transaction if all operations succeed
                 $transaction->commit();
                 Yii::$app->session->setFlash('success', 'All data saved successfully!');
                 return $this->refresh();

            } catch (\Exception $e) {
                // Rollback transaction if any error occurs
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Error occurred while saving data: ' . $e->getMessage());
            }
        }
        
        // Re-render the form with the current state
        return $this->render('index', [
            'clientModel' => $clientModel,
            'metalModel' => $metalModel,
            'stoneModels' => !empty($stonesData) ? $this->createDynamicModels($stonesData, StoneCalculation::class) : $stoneModels,
            'workModels' => !empty($workData) ? $this->createDynamicModels($workData, WorkCalculation::class) : $workModels,
        ]);
    }

    /**
     * Helper function to create dynamic models from POST data.
     * 
     * @param array $data
     * @param string $modelClass
     * @return array
     */
    private function createDynamicModels(array $data, string $modelClass)
    {
        $models = [];
        foreach ($data as $attributes) {
            $model = new $modelClass();
            $model->attributes = $attributes;
            $models[] = $model;
        }
        return $models;
    }



    
    


    
    // public function actionIndex($message = "Hello world")
    // {
    //     $model = new Numbers();
       
    //     if ($model->load(Yii::$app->request->post()) && $model->saveNumbers()) {
    //         Yii::$app->session->setFlash('success', 'Numbers have been saved successfully.');
    //         return $this->refresh();  // Refresh the page after success
    //     }

    //     return $this->render('test', [
    //         'model' => $model,
    //         'message' => $message
    //     ]);
    // }


}