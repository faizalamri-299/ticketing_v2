<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use frontend\modules\pentadbiran\models\KodCuti;
use frontend\modules\pentadbiran\models\Kakitangan;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KakitanganHasKodCuti */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="kakitangan-has-kod-cuti-form">
    <div class="card-box">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'makc_fk_maklumat_anggota_id')->dropDownList(
                    ArrayHelper::map(Kakitangan::find()->orderBy("ma_mod_nama_penuh ASC")->all(),'id','ma_mod_nama_penuh'),
                    ['prompt'=>'-- Pilih Kakitangan --']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'makc_fk_kod_cuti_id')->dropDownList(
                    ArrayHelper::map(KodCuti::find()->orderBy("id ASC")->all(),'id','mod_jenis'),
                    ['prompt'=>'-- Kategori Cuti--']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                 <?= $form->field($model, 'makc_mod_tahun')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                 <?= $form->field($model, 'makc_mod_jumlah_cuti')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-left">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>
 <?php ActiveForm::end(); ?>
