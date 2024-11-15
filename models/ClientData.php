<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_data".
 *
 * @property int $id
 * @property string $fio ФИО
 * @property string $phone Телефон
 * @property string $product_type Тип изделия
 * @property string $calculation_date Дата расчёта
 * @property string $manager Менеджер
 *
 * @property MetalCalculation[] $metalCalculations
 * @property StoneCalculation[] $stoneCalculations
 * @property WorkCalculation[] $workCalculations
 */
class ClientData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'phone', 'product_type', 'calculation_date', 'manager'], 'required'],
            [['calculation_date'], 'safe'],
            [['fio', 'phone', 'product_type', 'manager'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'phone' => 'Phone',
            'product_type' => 'Product Type',
            'calculation_date' => 'Calculation Date',
            'manager' => 'Manager',
        ];
    }

    /**
     * Gets query for [[MetalCalculations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetalCalculations()
    {
        return $this->hasMany(MetalCalculation::class, ['client_id' => 'id']);
    }

    /**
     * Gets query for [[StoneCalculations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoneCalculations()
    {
        return $this->hasMany(StoneCalculation::class, ['client_id' => 'id']);
    }

    /**
     * Gets query for [[WorkCalculations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkCalculations()
    {
        return $this->hasMany(WorkCalculation::class, ['client_id' => 'id']);
    }
}
