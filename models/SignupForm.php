<?php

namespace app\models;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: sergejandrejkin
 * Date: 12.12.17
 * Time: 8:45
 */

class SignupForm extends Model {

    public $login;
    public $password;
    public $name;
    public $birthday;


    public function rules()
    {
        return [
        [['login','name','password','birthday'], 'required' ],
        [['login','name'],'string'],
        [['birthday'],'date'],
        [['login'],'unique','targetClass'=>'app\models\User', 'targetAttribute' => 'login']
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->attributes = $this->attributes;
        return $user->create();
    }

}