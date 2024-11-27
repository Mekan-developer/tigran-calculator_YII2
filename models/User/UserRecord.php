<?php

namespace app\models\User;

use Yii;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 */
class UserRecord extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }

    // public function beforeSave($insert){
    //     $return = parent::beforeSave($insert);
    //     if($this->isAttributeChanged('password')){
    //         $this->password = Yii::$app->security->generatePasswordHash($this->password);
    //     }

    //     if($this->isNewRecord){
    //         $this->auth_key = Yii::$app->security->generateRandomKey($length = 255);
    //     }

    //     return $return;
    // }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isAttributeChanged('password')) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }

            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString(32);
            }

            return true;
        }
        return false;
    }



    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }





    public function getId(){
        return $this->id;
    }

    public static function findIdentity($id){
        return static::findOne($id);
    }

    public function getAuthKey(){
        return $this->auth_key; 
    }

    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }
    
    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException(
            'You can Authonticate by only username and password'
        );
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    
}
    // *******************************************