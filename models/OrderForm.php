<?php

namespace app\models;

use Yii;
use yii\base\Model;

class OrderForm extends Model
{
    public $first_date;
    public $second_date;
    public $car_id;

    public function rules()
    {
        return [
            [['car_id'], 'integer'],
            [['first_date', 'second_date', 'car_id'], 'required'],
            [['first_date', 'second_date'], 'date', 'format'=>'php:Y-m-d']
        ];
    }
}