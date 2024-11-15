<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CurrencyRateSearch extends CurrencyRate
{
    public $date_from; // Start date
    public $date_to;   // End date

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['currency'], 'string'],
            [['rate'], 'number'],
            [['date_from', 'date_to'], 'safe'],
            [['date_from'], 'validateStartDate'], // Custom validation for start date
            [['date_to'], 'validateEndDate'], // Custom validation for end date
        ];
    }

    /**
     * Custom validation to ensure the start date is within the last 10 days.
     */
    public function validateStartDate($attribute, $params)
    {
        $today = date('Y-m-d');
        $last10Days = date('Y-m-d', strtotime('-10 days'));

        if ($this->$attribute < $last10Days || $this->$attribute > $today) {
            $this->addError($attribute, 'Дата от должна быть в пределах последних 10 дней.');
        }
    }

    /**
     * Custom validation to ensure the end date is greater than the start date.
     */
    public function validateEndDate($attribute, $params)
    {
        if (!empty($this->date_from) && !empty($this->$attribute) && $this->$attribute < $this->date_from) {
            $this->addError($attribute, 'Дата до должна быть больше, чем Дата от.');
        }
    }

    /**
     * Search function for filtering data
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CurrencyRate::find()->orderBy(['date' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1'); // If validation fails, return no results
            return $dataProvider;
        }

        // Filter by date range
        if (!empty($this->date_from) && !empty($this->date_to)) {
            $query->andFilterWhere(['between', 'date', $this->date_from, $this->date_to]);
        } elseif (!empty($this->date_from)) {
            $query->andFilterWhere(['>=', 'date', $this->date_from]);
        } elseif (!empty($this->date_to)) {
            $query->andFilterWhere(['<=', 'date', $this->date_to]);
        }

        // Filter by currency
        if (!empty($this->currency)) {
            $query->andFilterWhere(['like', 'currency', $this->currency]);
        }

        return $dataProvider;
    }

    /**
     * Get unique currencies from the database for the dropdown.
     *
     * @return array
     */
    public static function getCurrencyOptions()
    {
        $currencies = CurrencyRate::find()
            ->select('currency')
            ->distinct()
            ->orderBy('currency ASC')
            ->all();

        return \yii\helpers\ArrayHelper::map($currencies, 'currency', 'currency');
    }
}
