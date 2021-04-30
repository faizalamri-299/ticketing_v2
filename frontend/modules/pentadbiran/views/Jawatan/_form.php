<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\Jawatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jawatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jt_fk_ut_id')->textInput() ?>

    <?= $form->field($model, 'jt_mod_kod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jt_mod_nama_jawatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jt_mod_ringkasan_peranan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
