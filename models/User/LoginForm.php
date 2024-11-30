<?php

namespace app\models\User;

use app\models\User\UserRecord;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * Rules for form validation
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Custom validation for password.
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in the user if the credentials are valid
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0); // 30 days of remember me
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     * @return UserRecord|null
     */
    // protected function getUser()
    // {
    //     if ($this->_user === false) {
    //         $this->_user = \app\models\User\UserRecord::findByUsername($this->username);
    //     }
    //     return $this->_user;
    // }

    protected function getUser()
{
    if ($this->_user === false) {
        // Use the UserRecord model to find the user
        $this->_user = UserRecord::findOne(['username' => $this->username]);
    }
    return $this->_user;
}


    private function fetchUser($username)
    {
        return UserRecord::findOne(compact('username'));
    }

    private function isCorrectHash($plaintext,$hash)
    {
        return Yii::$app->security->validatePassword($plaintext,$hash);
    }
}
