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
    $stoneModels = [new StoneCalculation()]; // Initialize with one empty model
    $workModels = [new WorkCalculation()];

    if ($clientModel->load(Yii::$app->request->post()) && $clientModel->validate()) {
        $transaction = Yii::$app->db->beginTransaction(); // Start transaction
        try {
            if ($clientModel->save()) {
                $metalModel->client_id = $clientModel->id;

                if ($metalModel->load(Yii::$app->request->post()) && $metalModel->validate() && $metalModel->save()) {
                    // Process Stone data
                    $stonesData = Yii::$app->request->post('StoneCalculation', []);
                    $stoneModels = [];
                    foreach ($stonesData as $stone) {
                        $stoneModel = new StoneCalculation();
                        $stoneModel->client_id = $clientModel->id;
                        $stoneModel->attributes = $stone;

                        if ($stoneModel->validate()) {
                            $stoneModel->save();
                            $stoneModels[] = $stoneModel;
                        } else {
                            throw new \Exception('Validation failed for Stone model: ' . json_encode($stoneModel->errors));
                        }
                    }

                    // Process Work data
                    $workData = Yii::$app->request->post('WorkCalculation', []);
                    $workModels = [];
                    foreach ($workData as $work) {
                        $workModel = new WorkCalculation();
                        $workModel->client_id = $clientModel->id;
                        $workModel->attributes = $work;

                        if ($workModel->validate()) {
                            $workModel->save();
                            $workModels[] = $workModel;
                        } else {
                            throw new \Exception('Validation failed for Work model: ' . json_encode($workModel->errors));
                        }
                    }

                    // Commit transaction if all operations succeed
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'All data saved successfully!');
                    return $this->refresh();
                }
            }
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