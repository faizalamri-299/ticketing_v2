<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\modules\pentadbiran\models\KodJenisDokumen;
use kartik\file\FileInput;
use yii\helpers\Url;

$kodDokumen = frontend\modules\pentadbiran\models\DokumenDigital::getKodJenisDokumenList(); 

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\DdDokumenDigital */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dd-dokumen-digital-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'dd_fk_kod_jenis_dokumen_id')->dropDownList($kodDokumen, ['id' => 'mod_keterangan', 'prompt'=>'Sila Pilih Dokumen']) 
                ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'dd_mod_tajuk_dokumen')->textInput(['maxlength' => true]) ?> 
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'dd_mod_no_rujukan')->textInput(['maxlength' => true]) ?> 
            </div>
        </div>
        <div class="row">
               <div class="col-md-6">
                    <?= $form->field($model, 'dd_mod_dokumen_daripada')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                     <?= $form->field($model, 'dd_mod_dokumen_kepada')->textInput(['maxlength' => true]) ?>
                </div>
        </div>
        <div class="row">
               <div class="col-md-6">
                    <?= $form->field($model, 'dd_mod_tarikh_terima')->widget(DateTimePicker::class,[
                    'options' => ['placeholder' => '--Sila Pilih Tarikh Terima--'],
                    'pluginOptions' => [
                    //'format' => 'dd/mm/yyyy H:i:s',
                    'todayHighlight' => true]]); ?>
                </div>
                <div class="col-md-6">
                     <?= $form->field($model, 'dd_mod_tarikh_serah')->widget(DateTimePicker::class,[
                    'options' => ['placeholder' => '--Sila Pilih Tarikh Serah--'],
                    'pluginOptions' => [
                    //'format' => 'dd/mm/yyyy H:i:s',
                    'todayHighlight' => true]]);?>
                </div>
        </div>
    </div>
</div>
    <?= $form->field($model, "tempFile")->widget(FileInput::class, [
        'options' => [
            'accept' => 'application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, image/*',
        ],
        'pluginOptions' => [
            'showPreview' => false,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false,
        ],
    ]); ?>


                    
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
