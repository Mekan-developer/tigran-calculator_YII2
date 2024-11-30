<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "metals".
 *
 * @property int $id
 * @property string $name Название
 * @property float $density Плотность
 */
class Metal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'density'], 'required'],
            [['density'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'density' => 'Плотность',
        ];
    }
}
