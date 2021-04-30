<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\TuntutanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tuntutan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'makt_fk_maklumat_anggota_id') ?>

    <?= $form->field($model, 'makt_fk_kod_tuntutan_id') ?>

    <?= $form->field($model, 'makt_sys_user_masuk') ?>

    <?= $form->field($model, 'makt_sys_tarikh_masuk') ?>

    <?php // echo $form->field($model, 'makt_sys_user_kemaskini') ?>

    <?php // echo $form->field($model, 'makt_sys_tarikh_kemaskini') ?>

    <?php // echo $form->field($model, 'makt_mod_tarikh_tuntutan') ?>

    <?php // echo $form->field($model, 'makt_mod_tempat_dituju') ?>

    <?php // echo $form->field($model, 'makt_mod_butiran_perjalanan') ?>

    <?php // echo $form->field($model, 'makt_mod_waktu_tiba_pejabat') ?>

    <?php // echo $form->field($model, 'makt_mod_waktu_bertolak') ?>

    <?php // echo $form->field($model, 'makt_mod_waktu_balik') ?>

    <?php // echo $form->field($model, 'makt_mod_jumlah_jam') ?>

    <?php // echo $form->field($model, 'makt_mod_hitungan_km') ?>

    <?php // echo $form->field($model, 'makt_mod_resit') ?>

    <?php // echo $form->field($model, 'makt_mod_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
