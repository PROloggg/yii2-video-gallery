<?php

namespace common\modules\video_gallery\src\models;

use Yii;


/**
 * This is the model class for table "video_and_entity".
 *
 * @property integer $id
 * @property integer $video_id
 * @property integer $entity_id
 * @property string $model_name
 */
class VideoAndEntity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video_and_entity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_id', 'entity_id'], 'integer'],
            [['model_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_id' => 'Video ID',
            'entity_id' => 'Entity ID',
            'model_name' => 'model name',
        ];
    }
}
