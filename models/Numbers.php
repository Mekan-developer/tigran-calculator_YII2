<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "numbers".
 *
 * @property int $id
 * @property int $a
 * @property int $b
 */
class Numbers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'numbers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['a', 'b'], 'required'],
            [['a', 'b'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'a' => 'A',
            'b' => 'B',
        ];
    }

    public function saveNumbers()
    {
        if ($this->validate()) {
            return $this->save();
        }
        return false;
    }
}
