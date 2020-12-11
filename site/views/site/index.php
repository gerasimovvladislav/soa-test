<?php

declare(strict_types=1);

use app\controllers\actions\IndexAction;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\weather\dto\WeatherAtDateDto;

/* @var $this yii\web\View */
/* @var $provider \yii\data\ArrayDataProvider */
/* @var $form \app\models\form\GetWeatherByDateForm */
$form = $data[IndexAction::ATTR_FORM];
/* @var $search \app\models\weather\dto\WeatherAtDateDto[] */
$search = $data[IndexAction::ATTR_HISTORY];
/* @var $search \app\models\weather\dto\WeatherAtDateDto */
$temperature = $data[IndexAction::ATTR_TEMPERATURE] ?? null;

$this->title = 'Главная';
?>
<div class="site-index">
    <div class="row">
		<?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissable">
				<?= Yii::$app->session->getFlash('error') ?>
            </div>
		<?php endif; ?>
        <div class="col-md-3">
            <?= $this->render('_form', [
                IndexAction::ATTR_MODEL => $form,
            ]); ?>
            <?php echo ($temperature->temp ?? false) ? "Температура {$temperature->temp} градусов" : ""; ?>
        </div>
    </div>
    <hr/>
    <div class="row">
            <?= GridView::widget([
                'dataProvider' => $provider,
                'columns' => [
                    [
                        'attribute' => Yii::t("app", "Температура"),
                        'value' => function(WeatherAtDateDto $model) {
							return $model->temp;
						},
                    ],
                    [
                        'attribute' => Yii::t("app", "Дата"),
                        'value' => function(WeatherAtDateDto $model) {
							return $model->date;
						},
                    ],
                ],
            ]) ?>

    </div>


</div>
