<?php

namespace app\controllers;

use app\models\CurrencyRateSearch;
use Yii;
use app\models\CurrencyRate;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use GuzzleHttp\Client;
use DOMDocument;
use DOMXPath;



/**
 * CurrencyRateController implements the CRUD actions for CurrencyRate model.
 */
class CurrencyRateController extends Controller
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
     * Lists all CurrencyRate models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $today = date('Y-m-d');

        // Check if the data has already been updated today
        $lastUpdate = Yii::$app->cache->get('currency_last_update');
     
        if (true) {
            $day = 30;
            // Update data for the last 10 days
            for ($i = 0; $i < $day; $i++) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $model = CurrencyRate::findOne(['date' => $date]);
                if (!$model) {
                    $this->fetchAndStoreCurrencyRates($date);
                }                
            }

            // Delete data older than 10 days
            $deleteDate = date('Y-m-d', strtotime(-1*($day-1) . " days"));
            CurrencyRate::deleteAll(['<', 'date', $deleteDate]);

            // Store today's date as the last update date
            Yii::$app->cache->set('currency_last_update', $today);
        }

        // Prepare the data provider for the grid view
        $searchModel = new CurrencyRateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single CurrencyRate model.
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
     * Creates a new CurrencyRate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CurrencyRate();

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
     * Updates an existing CurrencyRate model.
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
     * Deletes an existing CurrencyRate model.
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
     * Finds the CurrencyRate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CurrencyRate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CurrencyRate::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    // get currency:*******************************************************************************************************************************************


 /**
     * Fetch and store currency rates for the given date.
     *
     * @param string $date
     * @return void
     */
    protected function fetchAndStoreCurrencyRates($date)
    {

        $url = "https://www.cbr.ru/currency_base/daily/?UniDbQuery.Posted=True&UniDbQuery.To=" . urlencode(date('d.m.Y', strtotime($date)));
        $client = new Client();

        try {
            $response = $client->request('GET', $url);
            $html = $response->getBody()->getContents();
        } catch (\Exception $e) {
            Yii::error("Error fetching data: " . $e->getMessage());
            return;
        }

        $this->parseAndStoreCurrencyRates($html,$date);
    }

    /**
     * Parse HTML and store currency rates in the database.
     *
     * @param string $html
     * @return void
     */
    protected function parseAndStoreCurrencyRates($html, $date)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        // XPath to select rows of the currency table
        $rows = $xpath->query("//table[@class='data']//tr");
        
        foreach ($rows as $index => $row) {
            // Skip the header row
            if ($index === 0) {
                continue;
            }

            $columns = $xpath->query('.//td', $row);
            
            // Extract data from each column
            $currencyName = trim($columns->item(1)->nodeValue ?? '');
            $rate = str_replace(',', '.', trim($columns->item(4)->nodeValue ?? ''));

            // Process only USD and EUR
            if (in_array($currencyName, ['USD', 'EUR'])) {
                if ($currencyName && $rate) {
                    $this->storeOrUpdateCurrencyRate($date, $currencyName, $rate);
                }
            }
        }
    }

    

    /**
     * Save a single currency rate to the database.
     *
     * @param string $date
     * @param string $currency
     * @param float $rate
     * @return void
     */
    protected function storeOrUpdateCurrencyRate($date, $currency, $rate)
    {
        // Check if the record already exists
        $model = CurrencyRate::findOne(['date' => $date, 'currency' => $currency]);

        if ($model) {
            // Update the existing record
            $model->rate = $rate;
            if (!$model->update()) {
                Yii::error("Failed to update: $currency - $rate");
            } else {
                Yii::info("Updated: $currency - $rate");
            }
        } else {
            // Create a new record
            $model = new CurrencyRate();
            $model->date = $date;
            $model->currency = $currency;
            $model->rate = $rate;
            if (!$model->save()) {
                Yii::error("Failed to store: $currency - $rate");
            } else {
                Yii::info("Stored: $currency - $rate");
            }
        }
    }

}
