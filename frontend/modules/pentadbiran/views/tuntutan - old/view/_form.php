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
$KategoriTuntutan = frontend\modules\pentadbiran\models\Tuntutan::getKategoriList();
$KategoriA = frontend\modules\pentadbiran\models\Tuntutan::getKodTuntutanAList();
$KategoriB = frontend\modules\pentadbiran\models\Tuntutan::getKodTuntutanBList();
$KategoriC = frontend\modules\pentadbiran\models\Tuntutan::getKodTuntutanCList();
$KategoriD = frontend\modules\pentadbiran\models\Tuntutan::getKodTuntutanDList();
$KategoriE = frontend\modules\pentadbiran\models\Tuntutan::getKodTuntutanEList();
$Kategori = frontend\modules\pentadbiran\models\Tuntutan::getKod();

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\Tuntutan */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin( ); ?>
<div class="card-box">
<div class="tuntutan-form">    
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'makt_fk_maklumat_anggota_id')->widget(Select2::class, [
                    'data' => $NamaKakitangan,
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['id' => 'makt_fk_maklumat_anggota_id', 'placeholder' => 'Pilih Kakitangan...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'makt_mod_tarikh_tuntutan')->widget(DateTimePicker::class,['options' => ['placeholder' => '--Sila Pilih Tarikh Tuntutan--'],
                    'pluginOptions' => [
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd']]);?>
            </div> 
            <div class="col-md-3">
            <?= $form->field($model, 'makt_fk_kategori_tuntutan')->widget(Select2::class, [
                    'data' => $KategoriTuntutan,
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['id' => 'selectTuntutan', 'placeholder' => 'Pilih Tuntutan...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>
            <div class="jenis-tuntutan-A col-md-3" style="display: none">
            <?= $form->field($model, 'makt_fk_kod_tuntutan_id')->widget(Select2::class, [
                    'data' => $KategoriA,
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['id' => 'selectJenisTuntutanA', 'placeholder' => 'Pilih Tuntutan...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>
            <div class="jenis-tuntutan-B col-md-3" style="display: none">
            <?= $form->field($model, 'makt_fk_kod_tuntutan_id')->widget(Select2::class, [
                    'data' => $KategoriB,
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['id' => 'selectJenisTuntutanB', 'placeholder' => 'Pilih Tuntutan...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>
            <div class="jenis-tuntutan-C col-md-3" style="display: none">
            <?= $form->field($model, 'makt_fk_kod_tuntutan_id')->widget(Select2::class, [
                    'data' => $KategoriC,
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['id' => 'selectJenisTuntutanC', 'placeholder' => 'Pilih Tuntutan...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>
            <div class="jenis-tuntutan-D col-md-3" style="display: none">
            <?= $form->field($model, 'makt_fk_kod_tuntutan_id')->widget(Select2::class, [
                    'data' => $KategoriD,
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['id' => 'selectJenisTuntutanD', 'placeholder' => 'Pilih Tuntutan...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>
            <div class="jenis-tuntutan-E col-md-3" style="display: none">
            <?= $form->field($model, 'makt_fk_kod_tuntutan_id')->widget(Select2::class, [
                    'data' => $KategoriE,
                    'theme' => Select2::THEME_DEFAULT,
                    'options' => ['id' => 'selectJenisTuntutanE', 'placeholder' => 'Pilih Tuntutan...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>   
        </div>
    </div>
</div>

<div class="form-perjalanan" style="display:none">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'makt_mod_tempat_dituju')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'makt_mod_butiran_perjalanan')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'makt_mod_waktu_tiba_pejabat')->widget(TimePicker::classname(), []); ?>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">  
                <?=$form->field($model, 'makt_mod_waktu_bertolak')->widget(DateTimePicker::classname(), []);?>
            </div>
            <div class="col-md-3">
             <?= $form->field($model, 'makt_mod_waktu_balik')->widget(DateTimePicker::classname(), []);?>
            </div>
            <div class="col-md-3">
            <?= $form->field($model, 'makt_mod_jumlah_jam', ['addon' => ['append' => ['content' => 'Jam', ],]]) ?>
            </div>
            <div class="col-md-3">
            <?= $form->field($model, 'makt_mod_hitungan_km', ['addon' => ['append' => ['content' => 'KM', ],]]) ?>
            </div>
    </div>

    
</div> <!-- ending div  -->
<div class="resit col-md-12">
        <div class="row">
            <div class="col-md-12">
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

        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>

<!-- dependent dropdown jenis tuntutan and kategori tuntutan -->
<?php
$js = "
    function paparDropdown(JenisTuntutan) {
        var jp = JenisTuntutan;
        // alert(jp);
        $('.maklumat-tuntutan').hide();
        $('.resit').hide();
        switch(jp) {
        case '3':
            $('.jenis-tuntutan-A').toggle();
            $('.jenis-tuntutan-B').hide();
            $('.jenis-tuntutan-C').hide();
            $('.jenis-tuntutan-D').hide();
            $('.jenis-tuntutan-E').hide();
            break;
        case '9':
            $('.jenis-tuntutan-A').hide();
            $('.jenis-tuntutan-B').toggle();
            $('.jenis-tuntutan-C').hide();
            $('.jenis-tuntutan-D').hide();
            $('.jenis-tuntutan-E').hide();
            break;
        case '14':
            $('.jenis-tuntutan-A').hide();
            $('.jenis-tuntutan-B').hide();
            $('.jenis-tuntutan-C').toggle();
            $('.jenis-tuntutan-D').hide();
            $('.jenis-tuntutan-E').hide();
            break;
        case '23':
            $('.jenis-tuntutan-A').hide();
            $('.jenis-tuntutan-B').hide();
            $('.jenis-tuntutan-C').hide();
            $('.jenis-tuntutan-D').toggle();
            $('.jenis-tuntutan-E').hide();
            break;
        case '28':
            $('.jenis-tuntutan-A').hide();
            $('.jenis-tuntutan-B').hide();
            $('.jenis-tuntutan-C').hide();
            $('.jenis-tuntutan-D').hide();
            $('.jenis-tuntutan-E').toggle();
            break;
          default:
            $('.jenis-tuntutan-A').hide();
            $('.jenis-tuntutan-B').hide();
            $('.jenis-tuntutan-C').hide();
            $('.jenis-tuntutan-D').hide();
            $('.jenis-tuntutan-E').hide();
            break;
        }
        
    }
    $('#selectTuntutan').change(function(e){
        paparDropdown($(this).val());
    });

";

$this->registerJs($js);?>


<!-- paparan form -->
<?php
$js = "
    function paparFormA(FormTuntutan) {
        var fp = FormTuntutan;
        // alert(fp);
        $('.form-perjalanan').hide();
        $('.resit').hide();

        switch(fp) {
        case '3':
        case '4':
        case '5':
        case '6':
        case '7':
        case '9':
        case '10':
        case '11':
        case '12':
        case '13':
        case '14':
        case '15':
        case '17':
            $('.form-perjalanan').toggle();
            break;
        case '9':

            break;
        case '14':

            break;
        case '23':

            break;
        case '28':

            break;
          default:
            break;
        }
        
    }
    $('#selectJenisTuntutanA').change(function(e){
         paparFormA($(this).val());


    });

";

$this->registerJs($js);

?>