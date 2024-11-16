<?php

namespace app\controllers;

use Yii;
use GuzzleHttp\Client;
use app\models\MetalRate;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DOMDocument;
use DOMXPath;

/**
 * MetalRateController implements the CRUD actions for MetalRate model.
 */
class MetalRateController extends Controller
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
     * Lists all MetalRate models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $date_today = date('d.m.Y');
        $day = 30;
        // Check if the data has already been updated today
        $lastUpdatedMetalDate = Yii::$app->cache->get('currency_last_updated_metal_date');
        if ($lastUpdatedMetalDate != $date_today) {
            MetalRate::deleteAll();
            
            
            $date_last_30 = date('d.m.Y', strtotime("-$day days"));
            $url = "https://www.cbr.ru/hd_base/metall/metall_base_new/?UniDbQuery.Posted=True&UniDbQuery.From=$date_last_30&UniDbQuery.To=$date_today&UniDbQuery.Gold=true&UniDbQuery.Silver=true&UniDbQuery.Platinum=true&UniDbQuery.Palladium=true&UniDbQuery.so=1";
            $this->fetchAndStoreMetalRates($url);

            
            // Delete data older than 10 days
            $deleteDate = date('Y-m-d', strtotime(-1*($day-1) . " days"));
            MetalRate::deleteAll(['<', 'date', $deleteDate]);
            // Store today's date as the last update date
            Yii::$app->cache->set('currency_last_updated_metal_date', $date_today);
        }
         
        $dataProvider = new ActiveDataProvider([
            'query' => MetalRate::find(),

        ]);
        

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'day' => $day
        ]);


    }

    /**
     * Displays a single MetalRate model.
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
     * Creates a new MetalRate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MetalRate();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MetalRate model.
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
     * Deletes an existing MetalRate model.
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
     * Finds the MetalRate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MetalRate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MetalRate::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // *****************************************************************************************************


    protected function fetchAndStoreMetalRates($url)
    {
        $client = new Client();

        try {
            $response = $client->request('GET', $url);
            $html = $response->getBody()->getContents();
        } catch (\Exception $e) {
            Yii::error("Error fetching data: " . $e->getMessage());
            return;
        }

        $this->parseAndStoreMetalRates($html);
    }

    protected function parseAndStoreMetalRates($html)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        // XPath to select rows of the metal rates table
        $rows = $xpath->query("//table[@class='data']//tr");

        foreach ($rows as $index => $row) {
            // Skip the header row
            if ($index === 0) {
                continue;
            }

            $columns = $xpath->query('.//td', $row);

            // Ensure there are enough columns
            if ($columns->length < 5) {
                Yii::warning("Skipping row $index due to insufficient columns.");
                continue;
            }

            // Extract data from each column and sanitize the values
            $date = $columns->item(0)->nodeValue ?? null;
            $gold = $this->sanitizeRate($columns->item(1)->nodeValue ?? null);
            $silver = $this->sanitizeRate($columns->item(2)->nodeValue ?? null);
            $platinum = $this->sanitizeRate($columns->item(3)->nodeValue ?? null);
            $palladium = $this->sanitizeRate($columns->item(4)->nodeValue ?? null);

            // Convert date to Y-m-d format
            $date = date('Y-m-d', strtotime($date));

            // Save each metal rate
            $this->storeMetalRate($date, 'Gold', $gold);
            $this->storeMetalRate($date, 'Silver', $silver);
            $this->storeMetalRate($date, 'Platinum', $platinum);
            $this->storeMetalRate($date, 'Palladium', $palladium);
        }
    }

    protected function sanitizeRate($rate)
    {
        // Remove spaces and replace commas with dots
        $rate = str_replace([' ', ','], ['', '.'], $rate);

        // Ensure the value is numeric
        return is_numeric($rate) ? (float) $rate : null;
    }

    

    protected function storeMetalRate($date, $metal, $rate)
    {
        // Skip if rate is null or empty
        if (empty($rate)) {
            return;
        }

        // Check if the record already exists
        $model = MetalRate::findOne(['date' => $date, 'metal' => $metal]);

        if ($model) {
            $model->rate = $rate;

            if (!$model->update()) {
                Yii::error("Failed to update: $metal on $date with rate $rate. Errors: " . json_encode($model->errors));
            } else {
                Yii::info("Updated: $metal on $date with rate $rate");
            }
        } else {
            $model = new MetalRate();
            $model->date = $date;
            $model->metal = $metal;
            $model->rate = $rate;

            if (!$model->save()) {
                Yii::error("Failed to save: $metal on $date with rate $rate. Errors: " . json_encode($model->errors));
            } else {
                Yii::info("Saved successfully: $metal on $date with rate $rate");
            }
        }
    }


}
