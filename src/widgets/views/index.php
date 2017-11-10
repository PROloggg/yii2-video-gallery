<?php
use \yii\bootstrap\Html;
use yii\helpers\Url;

?>
<div class="video-list" data-role="video-list">
    <?php foreach ($models as $model) { ?>
        <?= Html::a($model->name . " | " . $model->date, $model->url, ['target' => '_blank']); ?>
        <?= Html::a('✖', Url::to(['/video_gallery/video/delete?id=' . $model->id]), [
            'class' => 'delete'
        ]) ?>
        <br>
    <?php } ?>
</div>
<?= $this->renderAjax('modal', [
    'owner' => $owner
]); ?>

<div data-role="video-forms"></div>