<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KpKlinikPanelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kp-klinik-panel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kp_mod_nama') ?>

    <?= $form->field($model, 'kp_mod_no_syarikat') ?>

    <?= $form->field($model, 'kp_mod_no_telefon') ?>

    <?= $form->field($model, 'kp_mod_emel') ?>

    <?php // echo $form->field($model, 'kp_mod_alamat1') ?>

    <?php // echo $form->field($model, 'kp_mod_alamat2') ?>

    <?php // echo $form->field($model, 'kp_mod_poskod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
