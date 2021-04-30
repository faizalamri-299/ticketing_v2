<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\PermohonanCutiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-cuti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id') ?> -->
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'pc_fk_id_kakitangan') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'pc_fk_id_kod_cuti') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'pc_mod_tarikh_mula') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'pc_mod_tarikh_tamat') ?>
        </div>

    <?php // echo $form->field($model, 'pc_sys_bil_cuti') ?>

    <?php // echo $form->field($model, 'pc_mod_jenis_cuti') ?>

    <?php // echo $form->field($model, 'pc_mod_keterangan') ?>

    <?php // echo $form->field($model, 'pc_mod_nama_surat_sokongan') ?>

    <?php // echo $form->field($model, 'pc_mod_surat_sokongan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

