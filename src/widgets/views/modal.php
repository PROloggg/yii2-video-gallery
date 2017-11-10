<?php
use kartik\datecontrol\DateControl;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php Modal::begin([
    'header' => '<h4 class="modal-title">Добавить видео</h4>',
    'id' => 'modal-video',
    'toggleButton' => [
        'class' => 'btn btn-success',
        'label' => 'Добавить',
        'tag' => 'button',
        'data-target' => '#modal-video',
    ],
]); ?>
<div class="conteiner">
    <div class="raw">
        <div class="col-sm-6">
            <?= Html::textInput('Video[name]', null, [
                'placeholder' => 'Название видео',
                'class' => 'form-control',
            ]); ?>
        </div>
        <div class="col-sm-6">
            <?= DateControl::widget([
                'name' => 'Video[date]',
                'type' => DateControl::FORMAT_DATE,
                'attribute' => null,
                'value' => date('Y-m-d'),
                'ajaxConversion' => false,
                'saveFormat' => 'php:Y-m-d',
                'displayFormat' => 'php:d.m.Y',
                'widgetOptions' => [
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ]
            ]); ?></div>
    </div>
    <br>
    <br>
    <br>
    <div class="raw">
        <div class="col-sm-12">
            <?= Html::textInput('Video[url]', null, [
                'placeholder' => 'URL',
                'class' => 'form-control',
            ]); ?>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="raw">
        <div class="col-sm-12">
            <?= Html::textarea('Video[description]', $null, [
                'placeholder' => 'Описание',
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="col-sm-12">
        <?= Html::button("Добавить видео", [
            'class' => 'btn btn-success col-sm-12',
            'data-dismiss' => "modal",
            'data-role' => 'add-video',
            'data-url' => Url::to(['/video_gallery/video']),
            'data-owner-model' => $owner::className(),
            'data-owner-model-id' => $owner->id,
        ]); ?>
    </div>
    <br>
    <br>
</div>
<?php Modal::end(); ?>
