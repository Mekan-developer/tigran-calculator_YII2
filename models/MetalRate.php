<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "metal_rates".
 *
 * @property int $id
 * @property string $date Дата
 * @property string $metal Металл
 * @property float $rate Курс, руб
 */
class MetalRate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metal_rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'metal', 'rate'], 'required'],
            [['date'], 'safe'],
            [['rate'], 'number'],
            [['metal'], 'string', 'max' => 255],
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
            'metal' => 'Metal',
            'rate' => 'Rate',
        ];
    }
}
