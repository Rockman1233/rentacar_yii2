<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract".
 *
 * @property integer $id
 * @property integer $car_id
 * @property integer $driver_id
 * @property string $status
 * @property string $first_date
 * @property string $second_date
 *
 * @property Car $car
 * @property User $driver
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contract';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_id', 'driver_id', 'status','first_date', 'second_date'], 'required'],
            [['car_id', 'driver_id', 'status'], 'integer'],
            [['first_date', 'second_date'], 'safe'],
            [['first_date', 'second_date'], 'date', 'format'=>'php:Y-m-d'],
            [['first_date', 'second_date'], 'default', 'value'=>date('Y-m-d')],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['driver_id' => 'id']],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car State Number',
            'driver_id' => 'Driver Name',
            'status' => 'Status',
            'first_date' => 'First Date',
            'second_date' => 'Second Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(User::className(), ['id' => 'driver_id']);
    }

    public function setStatus($status)
    {
        return $this->status = trim($status);
    }


}
