<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\modules\pentadbiran\models\Kakitangan;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\time\TimePicker;
use kartik\depdrop\DepDrop;

$NamaKakitangan = frontend\modules\pentadbiran\models\Tuntutan::getNamaKakitanganList();
$KodTuntutan = frontend\modules\pentadbiran\models\Tuntutan::getKodKeteranganList();
$KategoriTuntutan = frontend\modules\pentadbiran\models\KodKategoriTuntutan::getKodKategoriList();


/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\Tuntutan */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyC3tmAHBErKYHRSYBqwpfvYPhNAhMpGCUk&libraries=visualization" ,['position' => \yii\web\View::POS_HEAD]); ?>
<?= $this->registerJsFile("https://code.jquery.com/jquery-latest.min.js" ,['position' => \yii\web\View::POS_HEAD]);?>
<?= $this->registerJsFile("@web/js/gmap_routes_tuntutan2.js",['position' => \yii\web\View::POS_END]); ?>


<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
<div class="card-box">
    <div class="tuntutan-form">    
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'makt_fk_maklumat_anggota_id')->widget(Select2::class, [
                        'data' => $NamaKakitangan,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['id' => 'makt_fk_maklumat_anggota_id', 'placeholder' => 'Pilih Kakitangan...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]) ?>
                </div> 
                <div class="col-md-6">
                <?= $form->field($model, 'makt_fk_kategori_tuntutan')->widget(Select2::class, [
                        'data' => $KategoriTuntutan,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['id' => 'KategoriTuntutan', 'placeholder' => 'Pilih Tuntutan...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-header" style="display:none">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'makt_fk_kod_tuntutan_id')->widget(DepDrop::class, [
                        //'data' => $KodTuntutan,
                        //'type' => DepDrop::TYPE_SELECT2,

                        'data' => empty($model->makt_fk_kod_tuntutan_id) ? [''] : Tuntutan::getList($model->makt_fk_kod_tuntutan_id),
                        'options' => ['id'=>'JenisTuntutan',],
                        'pluginOptions' => [
                            'depends' => ['KategoriTuntutan'],
                            'placeholder' => 'Sila Pilih Tuntutan',
                            'url' => Url::to(['tuntutan/kategori']),
                            'allowClear' => true,
                        ]
                    ]); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'makt_mod_butiran_tuntutan')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div> 
    </div><!-- ending div class header -->

    <div class="form-harian" style="display:none">
       <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">  
                    <?=$form->field($model, 'makt_mod_waktu_keluar_pejabat')->widget(DateTimePicker::classname(), 
                    ['options' => ['placeholder' => '--Tarikh--','id'=>'masa-keluar','class' => 'masa'],]);?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'makt_mod_waktu_tiba_pejabat')->widget(DateTimePicker::classname(),
                    ['options' => ['placeholder' => '--Tarikh--','id'=>'masa-tiba','class' => 'masa'],]);?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'makt_mod_jam',['addon' => ['append' => ['content'=>'Jam',]]])->textInput(['maxlength' => true,'id'=>'jumlah-jam' , 'readOnly' => true]) ?>
                </div>
                <input type="hidden" id="jumlah" name="jumlah"/>
            </div>
        </div>
    </div><!-- ending div form perjalanan -->

    <div class="form-perjalanan" style="display:none">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'makt_mod_tempat_dari')->textInput(['maxlength' => true,
                    'id' => 'dari','class' => 'kiraanKM','value' => $model->isNewRecord ? 'Yayasan Kanser Tunku Laksamana Johor' : $model->makt_mod_tempat_dari]) ?>
                </div>    
                <div class="col-md-3">
                    <?= $form->field($model, 'makt_mod_tempat_dituju')->textInput(['maxlength' => true,
                    'id' => 'dituju','class' => 'kiraanKM']) ?>
                </div>
                <div class="col-md-3">  
                    <?=$form->field($model, 'makt_mod_waktu_bertolak')->widget(DateTimePicker::classname(), []);?>
                </div>
                <div class="col-md-3">  
                    <?=$form->field($model, 'makt_mod_waktu_balik')->widget(DateTimePicker::classname(), []);?>
                </div>    
            </div>
        </div>     

        <div class="map" style="display: none">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div id="map" class="map" style="height:540px"></div>
                    </div>
                    <div class="col-md-3">  
                        <?= $form->field($model, 'makt_mod_hitungan_km',
                            ['addon' => ['append' => ['content'=>'KM',]]])->textInput(['maxlength' => true,'id'=>'makt_mod_hitungan_km','class' => 'kiraanKM', 'readOnly' => true]) ?>
                    </div>
                    <div class="kereta col-md-3">
                        <?= $form->field($model, 'makt_mod_kiraan_tuntutan_perjalanan',
                            ['addon' => ['prepend' => ['content'=>'RM',]]])->textInput(['maxlength' => true,'id' => 'makt_mod_kiraan_tuntutan_perjalanan','class' => 'kiraanKM', 'readOnly' => true]) ?>
                    </div>  
                </div>
            </div>
        </div>          
    </div> 
    <div class="form-resit col-md-12" style="display:none">
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
    <br>
        <div class ="form-button" style="display:none">
            <div class="row">
                <div class="col-md-12 text-right">
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ending div card box -->

<?php ActiveForm::end(); ?>

<!-- paparan form -->
<?php
$js = "
    function paparForm(FormTuntutan) {
    var fp = FormTuntutan;
        // alert(fp);
            $('.form-header').hide();
            $('.form-harian').hide();
            $('.form-perjalanan').hide();
            $('.form-penginapan').hide();
            $('.form-button').hide();
            $('.form-resit').hide();

        switch(fp) {
        case '0':

        break;
        case '1':
            $('.form-header').show();
            $('.form-harian').show();
            $('.form-button').show();
        break;
        case '2':
            $('.form-header').show();
            $('.form-perjalanan').show();
            $('.form-button').show();
            $('.form-resit').show();
        break;
        case '3':
            $('.form-header').show();
            $('.form-button').show();
            $('.form-resit').show();
        break;
        case '4':
            $('.form-header').show();
            $('.form-button').show();
            $('.form-resit').show();
        break;
        case '5':
            $('.form-header').show();
            $('.form-button').show();
        break;
        case '6':
            $('.form-header').show();
            $('.form-button').show();
            $('.form-resit').show();
        break;

        default:
            $('.form-header').hide();
            $('.form-harian').hide();
            $('.form-perjalanan').hide();
            $('.form-penginapan').hide();
            $('.form-button').hide();
            $('.form-resit').hide();
        break;
        }
        
    }
    $('#KategoriTuntutan').change(function(e){
        paparForm($(this).val());


    });

";

$this->registerJs($js);

?>

<?php
$js = "
    function papar(flag) {
    var fl = flag;
        $('.kereta').hide();
        $('.motor').hide();
        $('.map').hide();
        $('.km').hide();
        $('.form-resit').show();

        switch(fl) {
        case '9':
            $('.kereta').show();
            $('.map').show();
            $('.km').show();
            $('.form-resit').hide();
            //kiraan(fl);
        break;
        case '10':
            $('.kereta').show();
            $('.map').show();
            $('.km').show();
            $('.form-resit').hide();
            //kiraan(fl);
        break;
        default:
            $('.kereta').hide();
            $('.motor').hide();
            $('.map').hide();
            $('.km').hide();
            $('.form-resit').show();
        break;
        }
        
    }

    // function kiraan(value)
    // {
    //     var jarak = $('#makt_mod_hitungan_km').val();

    //     if(value == '9')
    //     {
    //         var total = jarak * 0.8;
    //         $('#makt_mod_kiraan_tuntutan_perjalanan').val();
    //     }
    // }
    $('#JenisTuntutan').change(function(e){
        papar($(this).val());


    });

";

$this->registerJs($js);

?>


<?php
$js = "
$(document).ready(function() {
    var keluar = $('#masa-keluar'); 
    var tiba = $('#masa-tiba');
    
     
    $('.masa').change(function(e) {
      
        let datekeluar = new Date(keluar.val());
        let datetiba = new Date(tiba.val());

        var diff =Math.abs(datetiba.getTime() - datekeluar.getTime()) /1000 ; //diff in milliseconds
        var days    = Math.floor(diff / (3600 * 24));
        var hours   = Math.floor((diff - (days * (3600 * 24)))/3600);
        var minutes = Math.floor((diff - (days * (3600 * 24)) - (hours * 3600)) / 60);
        var jumlah = '';
        
        if(days>0){
        jumlah = days +' Hari : '+ hours +' Jam : ' + minutes + ' Minit' ; 
        }
        else
        {
        jumlah = hours +' Jam : ' + minutes + ' Minit' ; 
        }

        $('#jumlah-jam').val(jumlah);

    })
  });
";
$this->registerJs($js);
?>

