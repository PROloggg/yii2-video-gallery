<?php
namespace common\modules\video_gallery\src\behaviors;

use yii\base\Behavior;
use common\modules\video_gallery\src\models\Video;
use common\modules\video_gallery\src\models\VideoAndEntity;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class AttachVideos extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_UPDATE => 'setVideo',
            ActiveRecord::EVENT_AFTER_INSERT => 'setVideo',
            ActiveRecord::EVENT_BEFORE_DELETE => 'removeVideos',
        ];
    }

    public function getVideos()
    {
        return Video::find()
            ->where(['id' =>
                ArrayHelper::getColumn(VideoAndEntity::find()->where([
                    'entity_id' => $this->owner->id,
                    'model_name' => $this->owner::className()
                ])->all(), 'id')
            ])
            ->orderBy(['date' => SORT_DESC]);
    }


    public function setVideo()
    {
        $dataVideo = \Yii::$app->request->post('Video');

        if (!empty($dataVideo)) {
            $video = new Video();
            $video->name = $dataVideo['name'];
            $video->url = $dataVideo['url'];
            $video->description = $dataVideo['description'];
            $video->date = (!empty($dataVideo['date'])) ? $dataVideo['date'] : date('Y-m-d');
            if ($video->validate() && $video->save()) {
                $linkTable = new VideoAndEntity();
                $linkTable->entity_id = $this->owner->id;
                $linkTable->video_id = $video->id;
                $linkTable->model_name = $this->owner::className();
                $linkTable->save();
                return $video;
            }
        }
        return false;
    }


    public function removeVideos()
    {
        $videos = $this->getVideos()->all();

        foreach ($videos as $video) {
            $video->delete();
        }
    }
}