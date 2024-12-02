<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "metal_calculation".
 *
 * @property int $id
 * @property int $client_id Клиент
 * @property string $profile Профиль
 * @property float $height Высота
 * @property float $width Ширина
 * @property float $ring_size Размер кольца
 * @property string $metal Металл
 * @property float $tolerance Погрешность, %
 *
 * @property ClientData $client
 */
class MetalCalculation extends \yii\db\ActiveRecord
{

    public $weight;
    public $price_per_gram;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metal_calculation';
    }

    // public function getTotalMetalCost()
    // {
    //     return $this->weight * $this->price_per_gram;
    // }

    public function getTotalMetalCost()
    {
        return (float)$this->weight * (float)$this->price_per_gram;
    }



    /**
     * {@inheritdoc} 
     */
    public function rules()
    {
        return [
            [['client_id', 'profile', 'height', 'width','gap', 'ring_size', 'metal_id', 'rounding'], 'required'],
            [['client_id','metal_id'], 'integer'],
            [['height', 'width', 'ring_size', 'Зазор','tolerance'], 'number'],
            [['profile'], 'string', 'max' => 255],
            [['rounding'], 'integer', 'min' => 0, 'max' => 100], // Ensure rounding is between 0 and 100
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientData::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'ID клиента',
            'profile' => 'Профиль',
            'height' => 'Высота',
            'width' => 'Ширина',
            'gap' => 'Зазор между камнями',
            'ring_size' => 'Размер кольца',
            'metal' => 'Металл',
            'rounding' => 'Скругление',
            'tolerance' => 'Допуск',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(ClientData::class, ['id' => 'client_id']);
    }

    public function getMetal()
    {
        return $this->hasOne(Metal::class, ['id' => 'metal_id']);
    }
    
}
