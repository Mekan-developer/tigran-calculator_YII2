<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stones".
 *
 * @property int $id
 * @property string $material
 * @property string $cut
 * @property float $diameter
 * @property float $height
 */
class Stone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material', 'cut', 'diameter', 'height'], 'required'],
            [['diameter', 'height'], 'number'],
            [['material', 'cut'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'material' => 'Материал',
            'cut' => 'Огранка',
            'diameter' => 'Диаметр, мм',
            'height' => 'Высота, мм',
        ];
    }
}
