<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property int $photo_id
 * @property string $image
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * {@inheritdoc}
     */
    // public $photo;
    public function rules()
    {
        return [
            [['image'], 'safe'],
            [['image'], 'string'],
            // [['photo'],'file','extensions'=>'jpg,png,gif'],
          
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'photo_id' => 'Photo ID',
            'image' => 'Image',
        ];
    }
}
