<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodTuntutan */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

<div class="card-box">
<div class="kod-tuntutan-form">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-1">
                <?= $form->field($model, 'mod_kategori')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'mod_kod_tuntutan')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'mod_jenis_tuntutan')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'mod_keterangan')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'mod_penuntut')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'mod_kadar')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'mod_nilaian')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
    </div>
</div>
</div>

<?php ActiveForm::end(); ?>