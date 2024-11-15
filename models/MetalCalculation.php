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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metal_calculation';
    }

    public function getTotalMetalCost()
    {
        return $this->weight * $this->price_per_gram;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'profile', 'height', 'width', 'ring_size', 'metal', 'tolerance'], 'required'],
            [['client_id'], 'integer'],
            [['height', 'width', 'ring_size', 'tolerance'], 'number'],
            [['profile', 'metal'], 'string', 'max' => 255],
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
            'client_id' => 'Client ID',
            'profile' => 'Profile',
            'height' => 'Height',
            'width' => 'Width',
            'ring_size' => 'Ring Size',
            'metal' => 'Metal',
            'tolerance' => 'Tolerance',
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
}
