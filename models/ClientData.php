<?php

namespace app\models;
use app\models\User;


use Yii;

/**
 * This is the model class for table "client_data".
 *
 * @property int $id
 * @property string $fio ФИО
 * @property string $phone Телефон
 * @property string $product_type Тип изделия
 * @property string $calculation_date Дата расчёта
 * @property string $user_id Менеджер
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
        // return [
        //     [['fio', 'phone', 'product_type', 'calculation_date', 'user_id'], 'required'],
        //     [['calculation_date'], 'safe'],
        //     [['fio', 'phone', 'product_type'], 'string', 'max' => 255],
        //     [['user_id'], 'integer'],
        //     [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        // ];

        return [
            [['fio', 'phone', 'product_type', 'calculation_date', 'user_id'], 'required'], // Fields that cannot be empty
            [['calculation_date'], 'safe'], // Validates the date, can be safely inserted
            [['fio', 'phone', 'product_type'], 'string', 'max' => 255], // Maximum length for string fields
            [['user_id'], 'integer'], // Ensures user_id is an integer
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']], // Ensures that user_id exists in the User table
        ];
    }


    // public function rules()
    // {
    //     return [
    //         [['fio', 'phone', 'product_type', 'calculation_date', 'user_id'], 'required'],
    //         [['calculation_date'], 'safe'],
    //         [['fio', 'phone', 'product_type'], 'string', 'max' => 255],
    //         [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
    //     ];
        
    // }

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
            'user_id' => 'Manager',
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

    public function getClient()
    {
        return $this->hasOne(ClientData::class, ['id' => 'client_id']);
    }
    public function getManagers()
    {
        return $this->hasMany(User::class, ['user_id' => 'id']);
    }
}
