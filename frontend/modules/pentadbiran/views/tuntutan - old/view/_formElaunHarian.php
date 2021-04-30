<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\modules\pentadbiran\models\Kakitangan;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\time\TimePicker;
use kartik\depdrop\DepDrop;

$NamaKakitangan = frontend\modules\pentadbiran\models\Tuntutan::getNamaKakitanganList();
$KodTuntutan = frontend\modules\pentadbiran\models\Tuntutan::getKodKeteranganList();

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\Tuntutan */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin( ); ?>
<div class="card-box">
<div class="maklumat-tuntutan">
    <h4>Elaun Baju Panas</h4><br>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
            <?= $form->field($model, 'makt_mod_tarikh_tuntutan')->widget(DateTimePicker::classname(), []);?>
            </div>
            <div class="col-md-3">
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
            </div>
        </div>
    </div>
</div> <!-- ending div  -->
    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

