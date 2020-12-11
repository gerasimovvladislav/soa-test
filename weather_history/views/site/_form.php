<?php

declare(strict_types=1);

use app\models\form\GetWeatherByDateForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\form\GetWeatherByDateForm */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['data-pjax' => true]]); ?>
    <?= $form->field($model, GetWeatherByDateForm::ATTR_DATE); ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Получить'), ['class' => 'btn btn-primary']); ?>
    </div>
<?php ActiveForm::end(); ?>
