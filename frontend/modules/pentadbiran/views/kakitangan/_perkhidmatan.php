<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\url;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\datecontrol\DateControl;
use frontend\modules\pentadbiran\models\KakitanganHasJawatan;

$kodUnit = frontend\modules\pentadbiran\models\KakitanganHasJawatan::getKodUnit();

/* @var $this yii\web\View */
/* @var $modelPsg frontend\modules\pentadbiran\models\KodJenisDokumen */

$this->title = 'Pendaftaran Maklumat Perkhidmatan';

?>
<div class="maklumat-perkhidmatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($modelPerkhidmatan, 'kajt_flag_eksekutif')->radioList($modelPerkhidmatan->dataEksekutif(), ['inline'=>true]);?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($modelPerkhidmatan, 'kajt_mod_kategori_anggota')->radioList($modelPerkhidmatan->dataKategoriAnggota(), ['inline'=>true]);?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($modelPerkhidmatan, 'kajt_mod_unit')->dropDownList($kodUnit, ['id' => 'myUnit', 'prompt'=>'--SILA PILIH--']) ?>
                </div>
                 <div class="col-md-4"> 
                 <?= $form->field($modelPerkhidmatan, 'kajt_fk_jawatan_id')->widget(DepDrop::classname(), [
                    'data' => empty($modelPerkhidmatan->kajt_fk_jawatan_id) ? [''] : KakitanganHasJawatan::getList($modelPerkhidmatan->kajt_mod_unit),
                    'options' => ['id'=>'myJawatan'],
                    'pluginOptions' => [
                        'depends' => ['myUnit'],
                        'placeholder' => 'Sila Pilih Jawatan',
                        'url' => Url::to(['kakitangan/jawatan']),
                    ]
                ]); ?>
                </div>
            </div>
        </div>
    </div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($modelPerkhidmatan, 'kajt_mod_no_kakitangan')->textInput(['maxlength' => true]) ?>
                </div>
            <div class="col-md-4">
                <?= $form->field($modelPerkhidmatan, 'kajt_mod_tarikh_lantikan')->widget(DateControl::classname(), [
                'type' => DateControl::FORMAT_DATE,
                'ajaxConversion'=>true,
                'options' => [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ]
                ]);?>
            </div>
            <div class="col-md-4">
                <?= $form->field($modelPerkhidmatan, 'kajt_mod_tarikh_tamat')->widget(DateControl::classname(), [
                'type' => DateControl::FORMAT_DATE,
                'ajaxConversion'=>true,
                'options' => [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ]
                ]);?>
            </div>
        </div> 
    </div>
</div>

    <hr/>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= Html::a('<< Kembali', ['create', 'idPu' => $idPu, 'tab' => 3], ['class' => 'btn btn-secondary waves-effect width-md waves-light']); ?>

                <?= Html::submitButton('Simpan' ,['create', 'idPu' => $idPu, 'class' => 'btn btn-primary waves-effect width-md waves-light pull-right']); ?>
                
            </div>
        </div>
        <div class="col-md-6 text-right">
            <div class="form-group">
                <?= Html::a('Selesai', ['index'], ['class' => 'btn btn-secondary waves-effect width-md waves-light']); ?>
            </div>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
