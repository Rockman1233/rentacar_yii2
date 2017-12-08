<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property integer $id
 * @property string $mark
 * @property string $model
 * @property string $colour
 * @property string $state_num
 * @property integer $price
 * @property integer $status
 * @property string $foto
 * @property string $description
 *
 * @property Contract[] $contracts
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mark', 'model', 'colour', 'state_num'],'required'],
            [['price', 'status'], 'integer'],
            [['description'], 'string'],
            [['mark', 'model', 'colour', 'state_num', 'foto'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mark' => 'Mark',
            'model' => 'Model',
            'colour' => 'Colour',
            'state_num' => 'State Num',
            'price' => 'Price',
            'status' => 'Status',
            'foto' => 'Foto',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */



    public function saveImage($filename){
        $this->foto = $filename;
        //отключим валидацию
        return $this->save(false);
    }
    public function getImage(){
        if($this->foto){
            return '/web/uploads/'.$this->foto;
        }
        return '/web/uploads/no_foto.jpg';
    }
    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->foto);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}