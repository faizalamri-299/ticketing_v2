<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodCuti */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card-box">
    <div class="kod-cuti-form">
        <div class="row">
        <div class="col-md-4">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'mod_jenis')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
        <?= $form->field($model, 'mod_keterangan')->textInput(['maxlength' => true]) ?>
        </div>
        </div>
        
        <div class="form-group" align="right">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
