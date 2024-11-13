<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency_rates".
 *
 * @property int $id
 * @property string $date Дата
 * @property string $currency Валюта
 * @property float $rate Курс, руб
 */
class CurrencyRate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency_rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'currency', 'rate'], 'required'],
            [['date'], 'safe'],
            [['rate'], 'number'],
            [['currency'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'currency' => 'Currency',
            'rate' => 'Rate',
        ];
    }
}
