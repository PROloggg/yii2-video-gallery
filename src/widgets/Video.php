<?php
namespace common\modules\video_gallery\src\widgets;

use common\modules\video_gallery\src\assets\VideoAsset;

class Video extends \yii\base\Widget
{
    public $owner = null;

    public function init()
    {
        parent::init();
        VideoAsset::register($this->getView());
    }

    public function run()
    {
        if ($this->owner) {
            $models = $this->owner->getVideos()->all();
        }
        if ($this->owner->id) {
            return $this->render('index', [
                'models' => $models,
                'owner' => $this->owner
            ]);
        }
        return false;
    }
}