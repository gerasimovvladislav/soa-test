<?php

/* @var $this yii\web\View */
/* @var $model \app\models\form\GetWeatherByDateForm */

use yii\widgets\Pjax;
use yii\grid\GridView;

$this->registerJs(
    '$("document").ready(function() {
        $("#form").on("pjax:end", function() {
            $.pjax.reload({container: "#notes", async: false});
        });
    });'
);

$this->title = 'Главная';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-3">
            <?php Pjax::begin(['id' => 'form']) ?>
                <?= $this->render('_form', [
                    'model' => $model,
                ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <hr/>
    <div class="row">
		<?php Pjax::begin(['id' => 'notes']) ?>
            <?= GridView::widget([
                'dataProvider' => $provider,
                'formatter' => [
                    'class'          => 'yii\i18n\Formatter',
                    'dateFormat'     => 'd-F-Y',
                    'datetimeFormat' => 'php:d-F-Y H:i:s',
                    'timeFormat'     => 'H:i:s',
                    'timeZone'       => 'Europe/Moscow'
                ],
                'columns' => [
                    [
                        'attribute' => $search::ATTR_TITLE,
                        'value'     => RefOpinion::ATTR_TITLE,
                    ],
                ],
            ]) ?>
		<?php Pjax::end(); ?>

    </div>


</div>
