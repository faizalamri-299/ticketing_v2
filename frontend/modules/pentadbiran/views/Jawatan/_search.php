<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\JawatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jawatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jt_fk_ut_id') ?>

    <?= $form->field($model, 'jt_mod_kod') ?>

    <?= $form->field($model, 'jt_mod_nama_jawatan') ?>

    <?= $form->field($model, 'jt_mod_ringkasan_peranan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
