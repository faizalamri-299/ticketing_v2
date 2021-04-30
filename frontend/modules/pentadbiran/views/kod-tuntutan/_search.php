<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodTuntutanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kod-tuntutan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mod_kod_tuntutan') ?>

    <?= $form->field($model, 'mod_jenis_tuntutan') ?>

    <?= $form->field($model, 'mod_keterangan') ?>

    <?= $form->field($model, 'mod_penuntut') ?>

    <?php // echo $form->field($model, 'mod_kadar') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
