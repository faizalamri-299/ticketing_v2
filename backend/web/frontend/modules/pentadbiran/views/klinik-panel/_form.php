<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KpKlinikPanel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kp-klinik-panel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kp_mod_nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kp_mod_no_syarikat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kp_mod_no_telefon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kp_mod_emel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kp_mod_alamat1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kp_mod_alamat2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kp_mod_poskod')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
