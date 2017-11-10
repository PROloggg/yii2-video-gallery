<?php

namespace common\modules\video_gallery\src\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property string $date
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['name', 'url'], 'string', 'max' => 255],
            [['name', 'url'], 'required'],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'description' => 'Description',
            'date' => 'Date',
        ];
    }

    public function getVideoAndEntity()
    {
        return $this->hasMany(VideoAndEntity::className(), ['video_id' => 'id']);
    }

    public function afterDelete()
    {
        $this->getVideoAndEntity()->one()->delete();
        parent::afterDelete();
    }
}
