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
            [['client_id', 'work_type', 'cost'], 'required'],
            [['client_id'], 'integer'],
            [['cost'], 'number'],
            [['work_type'], 'string', 'max' => 255],
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
            'work_type' => 'Work Type',
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
}
