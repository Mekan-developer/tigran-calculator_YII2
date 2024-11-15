<?php 

namespace app\controllers;

use Yii;
use app\models\Numbers;
use yii\web\Controller;
use app\models\ClientData;
use app\models\MetalCalculation;
use app\models\StoneCalculation;
use app\models\WorkCalculation;

class CalculatorController extends Controller{

    public function actionIndex()
    {
        $clientModel = new ClientData();
        $metalModel = new MetalCalculation();
        $stoneModel = new StoneCalculation();
        $workModels = [new WorkCalculation()];  // Initialize with one empty model
    
        if ($clientModel->load(Yii::$app->request->post()) && $clientModel->save()) {
            // Assign client ID to related models
            $metalModel->client_id = $clientModel->id;
            $stoneModel->client_id = $clientModel->id;
    
            if ($metalModel->load(Yii::$app->request->post()) && $metalModel->save() &&
                $stoneModel->load(Yii::$app->request->post()) && $stoneModel->save()) {
    
                $workTypes = Yii::$app->request->post('WorkCalculation')['work_type'];
                $costs = Yii::$app->request->post('WorkCalculation')['cost'];
    
                // Ensure that workTypes and costs arrays have the same count
                if (count($workTypes) === count($costs)) {
                    for ($i = 0; $i < count($workTypes); $i++) {
                        $workModel = new WorkCalculation();
                        $workModel->client_id = $clientModel->id;
                        $workModel->work_type = $workTypes[$i];
                        $workModel->cost = $costs[$i];
    
                        // Save only valid models
                        if ($workModel->validate()) {
                            $workModels[] = $workModel; // Store validated models
                        }
                    }
    
                    // Save all valid work models
                    foreach ($workModels as $workModel) {
                        $workModel->save();
                    }
    
                    Yii::$app->session->setFlash('success', 'All data saved successfully!');
                    return $this->refresh();
                }
            }
        }
    
        return $this->render('index', [
            'clientModel' => $clientModel,
            'metalModel' => $metalModel,
            'stoneModel' => $stoneModel,
            'workModels' => $workModels,
        ]);
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