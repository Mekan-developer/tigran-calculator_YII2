<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stone_calculation".
 *
 * @property int $id
 * @property int $client_id Клиент
 * @property string $stone Камень
 * @property float $cost_per_unit Стоимость за 1 шт
 * @property int $max_possible Возможный максимум
 * @property int $quantity Кол-во
 * @property float $setting_cost Стоимость закрепки за 1 шт
 *
 * @property ClientData $client
 */
class StoneCalculation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stone_calculation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'stone_id', 'cost_per_unit', 'max_possible', 'quantity', 'setting_cost'], 'required'],
            [['client_id', 'stone_id', 'max_possible', 'quantity'], 'integer'],
            [['cost_per_unit', 'setting_cost'], 'number'],
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
            'stone_id' => 'Stone',
            'cost_per_unit' => 'Cost Per Unit',
            'max_possible' => 'Max Possible',
            'quantity' => 'Quantity',
            'setting_cost' => 'Setting Cost',
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
    public function getStone()
    {
        return $this->hasOne(Stone::class, ['id' => 'stone_id']);
    }
}
