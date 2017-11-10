<?php

namespace common\modules\video_gallery\src\controllers;

use common\models\Athlete;
use common\modules\video_gallery\src\models\Video;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class VideoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'ajax' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $video = \Yii::$app->request->post('Video');
            $model = $video["owner"]::find()->where(['id' => $video["ownerId"]])->one();
            $result = $model->setVideo();
            if ($result) {
                return $result->id;
            }
            return "error";
        }
    }

    public function actionDelete($id)
    {
        $model = Video::find()->where(['id' => $id])->one();
        if ($model) {
            $model->delete();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}