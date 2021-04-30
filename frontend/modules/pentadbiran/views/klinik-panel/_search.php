<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KlinikPanelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="klinik-panel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id') ?> -->
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'kp_mod_nama') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'kp_mod_no_syarikat') ?>
        </div>
    </div>
    <div class="row">
         <div class="col-md-6">
            <?= $form->field($model, 'kp_mod_no_telefon') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'kp_mod_emel') ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'kp_mod_alamat1') ?>

    <?php // echo $form->field($model, 'kp_mod_alamat2') ?>

    <?php // echo $form->field($model, 'kp_mod_poskod') ?>

    <?php // echo $form->field($model, 'kp_mod_daerah') ?>

    <?php // echo $form->field($model, 'kp_mod_negeri') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
