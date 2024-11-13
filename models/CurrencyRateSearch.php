<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CurrencyRateSearch extends CurrencyRate
{
    public $date_from; // For calendar filter (start date)
    public $date_to;   // For calendar filter (end date)

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['currency'], 'string'],
            [['rate'], 'number'],
            [['date', 'date_from', 'date_to'], 'safe'],
        ];
    }

    /**
     * Search function for filtering data
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CurrencyRate::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1'); // If validation fails, return no results
            return $dataProvider;
        }

        // Filter by exact date
        if (!empty($this->date)) {
            $query->andFilterWhere(['date' => $this->date]);
        }

        // Filter by date range
        if (!empty($this->date_from) && !empty($this->date_to)) {
            $query->andFilterWhere(['between', 'date', $this->date_from, $this->date_to]);
        }

        // Filter by currency
        if (!empty($this->currency)) {
            $query->andFilterWhere(['like', 'currency', $this->currency]);
        }

        return $dataProvider;
    }
}
