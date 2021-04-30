<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KakitanganHasKodCutiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kakitangan-has-kod-cuti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_makc_maklumat_anggota_id') ?>

    <?= $form->field($model, 'fk_makc_kod_cuti_id') ?>

    <?= $form->field($model, 'makc_mod_tahun') ?>

    <?= $form->field($model, 'makc_mod_jumlah_cuti') ?>

    <?php // echo $form->field($model, 'makc_sys_baki_cuti') ?>

    <?php // echo $form->field($model, 'makc_mod_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
