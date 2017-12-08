<?php
/**
 * Created by PhpStorm.
 * User: Rock
 * Date: 06.12.2017
 * Time: 12:08
 */

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model {

    public $image;

    public  function rules()
    {

        return [
            [['image'], 'required'],
            [['image'], 'file','extensions'=>'jpg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        if ($this->validate()) {
            //если в БД уже есть картинка то затираем в папке картинку с названием схожим с названием в папке
            if (file_exists('../web/uploads/' . $currentImage) && is_file('../web/uploads/' . $currentImage)) {
                $this->deleteCurrentImage($currentImage);
            }
            //хэшируем имя для того чтчоб не было одинаковых
            $filename_hash = strtolower(uniqid($file->baseName) . '.' . $file->extension);
            //file является объектом класса UploadedFile и у него есть св-во "Имя"
            $file->saveAs('../web/uploads/' . $filename_hash);
            return $filename_hash;
        }
    }

    public function deleteCurrentImage($currentImage)
    {
        unlink('../web/uploads/' . $currentImage);
    }

}