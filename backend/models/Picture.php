<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property int $pic_id
 * @property string $picture
 * @property string $title
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'title'], 'required'],
            [['image'], 'safe','on' => 'update-photo-upload'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pic_id' => 'Pic ID',
            'image' => 'image',
            'title' => 'Title',
        ];
    }
     public function beforeSave($insert)
    {
        if (is_string($this->image) && strstr($this->image, 'data:image')) {

            // creating image file as png
            $data = $this->image;
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
            $fileName = time() . '-' . rand(100000, 999999) . '.png';
            // echo $fileName;die;
            // echo Yii::getAlias('@backend').'/uploads/';die;
            file_put_contents('D:/xampp/htdocs/projectsss/backend/uploads/'  . $fileName, $data);
           

            // deleting old image 
            // $this->image is real attribute for filename in table
            // customize your code for your attribute  
                      
            // if (!$this->isNewRecord && !empty($this->image)) {
            // echo Yii::getAlias('@webroot').'/uploads/';die;
            // unlink('uploads/'.$this->image);
                
            // }
            
            // set new filename
            $this->image = $fileName;
        }

        return parent::beforeSave($insert);
    }
}
