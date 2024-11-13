<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property int $id
 * @property string $work_name
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_name'], 'required'],
            [['work_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_name' => 'Работа',
        ];
    }
}
