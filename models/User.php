<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(){
        return 'utente';
    }

    public function rules(){
        return [
            [['email'], 'required'],
            [['password'], 'required']
        ];
    }

    public static function findIdentity($id){
        $user = self::find()
            ->where([
                "id" => $id
            ])
            ->one();
        if ($user == null) {
        return null;
        }
        return new static($user);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByEmail($email){
        $user = self::find()
            ->where([
                "email" => $email
            ])
            ->one();
        if ($user == null) {
            return null;
        }
        
        return new static($user);
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return "";
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }

    public function validatePassword($password){
        return $this->password === $password;
    }
}
