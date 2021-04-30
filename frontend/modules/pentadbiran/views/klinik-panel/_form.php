<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\pentadbiran\models\KodDaerah;
use frontend\modules\pentadbiran\models\KodNegeri;
/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KlinikPanel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-box">
<div class="klinik-panel-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12"> 
            <?= $form->field($model, 'kp_mod_nama')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'kp_mod_no_syarikat')->textInput(['maxlength' => true]) ?>
        </div>
         <div class="col-md-4"> 
            <?= $form->field($model, 'kp_mod_no_telefon')->textInput(['maxlength' => true]) ?>
        </div>
         <div class="col-md-4"> 
            <?= $form->field($model, 'kp_mod_emel')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
     <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'kp_mod_alamat1')->textInput(['maxlength' => true , 'placeholder' => 'No PO/No Rumah/Tingkat']) ?>
            <?= $form->field($model, 'kp_mod_alamat2')->textInput(['maxlength' => true , 'placeholder' => 'Blok/Jalan/Taman'])?>
        </div>
    </div>
     <div class="row">
        <div class="col-md-4"> 
            <?= $form->field($model, 'kp_mod_poskod')->textInput(['maxlength' => true , 'placeholder' => 'Poskod']) ?>
        </div>
         <div class="col-md-4">
            <?= $form->field($model, 'kp_mod_daerah')->dropDownList(
                    ArrayHelper::map(KodDaerah::find()->all(),'id','keterangan'),
                    ['prompt'=>'-- Pilih Daerah--']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'kp_mod_negeri')->dropDownList(
                    ArrayHelper::map(KodNegeri::find()->all(),'id','keterangan'),
                    ['prompt'=>'-- Pilih Negeri--']) ?>
        </div>
    </div>
    <div class="form-group" align="right">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
