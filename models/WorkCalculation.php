<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_calculation".
 *
 * @property int $id
 * @property int $client_id Клиент
 * @property string $work_type Тип работ
 * @property float $cost Стоимость
 *
 * @property ClientData $client
 */
class WorkCalculation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_calculation';
    }

    /**
     * {@inheritdoc}
     */


    public function rules()
    {
        return [
            
            [['work_id', 'client_id'], 'required'],
            [['work_id', 'client_id'], 'integer'],
            [['cost'], 'number', 'min' => 0, 'tooSmall' => 'Cost must be a positive number.'],
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
            'work_id' => 'Work Type',
            'cost' => 'Cost',
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

    public function getWork()
    {
        return $this->hasOne(Work::class, ['id' => 'work_id']);
    }
}
