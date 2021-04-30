<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
//use frontend\modules\pentadbiran\models\KodCuti;
//use frontend\modules\pentadbiran\models\Kakitangan;
//use frontend\modules\pentadbiran\models\KakitanganHasKodCuti;
use frontend\modules\pentadbiran\models\PermohonanCuti;

$kakitanganName = frontend\modules\pentadbiran\models\PermohonanCuti::getKakitanganName(); 
$kategoriCuti = frontend\modules\pentadbiran\models\KodKategoriCuti::getKodKategoriCutiList();

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\PermohonanCuti */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="permohonan-cuti-form">
    <div class="card-box">
        <div class="row">
            <div class="col-md-12">
             <?= $form->field($model, 'pc_fk_maklumat_anggota_id')->dropDownList($kakitanganName, ['id' => 'myKakitangan', 'prompt'=>'-- Pilih Kakitangan --']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"> 
                 <?= $form->field($model, 'pc_fk_kod_cuti_id')->widget(DepDrop::classname(), [
                  'data' => empty($model->pc_fk_kod_cuti_id) ? [''] : PermohonanCuti::getList($model->pc_fk_maklumat_anggota_id),
                    'options' => ['id'=>'myCuti'],
                    'pluginOptions' => [
                        'depends' => ['myKakitangan'],
                        'placeholder' => 'Sila Pilih Cuti',
                       'url' => Url::to(['permohonan-cuti/cuti']),
                    ]
                ]); ?>
            </div>
            <div class="col-md-6">
            <?= $form->field($model, 'pc_mod_jenis_cuti')->widget(Select2::class, [
                        'data' => $kategoriCuti,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['id' => 'kategoriCuti', 'placeholder' => '--Pilih Jenis Cuti--'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]) ?>
            </div>
        </div>                
        <div class="full-day-form">
            <div class="row">
                <div class="col-md-6">
                     <?= $form->field($model, 'tarikh')->widget(DateRangePicker::class,[
                                'options' => ['placeholder' => '--Sila Pilih Tarikh Cuti--'],
                                'convertFormat' => true,    
                                'pluginOptions' => [
                                'orientation' => 'bottom left', //display the calendar at bottom
                                'autoclose' => true,
                                'locale' => ['format' => 'd-M-y'],
                                'todayHighlight' => true,
                            ],
                        ]); ?>
                </div>
            </div>
        </div>
        <div class="half-day-form">
            <div class="row">
                <div class="col-md-6">
                     <?= $form->field($model, 'pc_mod_tarikh_mula')->widget(DatePicker::class,[
                                'options' => ['placeholder' => '--Sila Pilih Tarikh Cuti--'],
                                'pluginOptions' => [
                                'orientation' => 'bottom left', //display the calendar at bottom
                                'format' => 'd-M-yy ',
                                'autoclose' => true,
                                'startDate' => date('d-M-yy '), //disable date before
                                'todayHighlight' => true]]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'pc_mod_keterangan')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'tempSurat')->widget(FileInput::classname(),[
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
         <div class="row">
            <div class="col-md-12 text-left">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<!--Paparan form-->
<?php
$js = "
    $(document).ready(function() {
        $('.full-day-form').show();
        $('.half-day-form').hide();
    });

    function paparForm(PermohonanCutiForm) {
    var fp = PermohonanCutiForm;
        // alert(fp);
           
            $('.full-day-form').show();
            $('.half-day-form').hide();
        switch(fp) {
        case '0':

        break;
        case '1':
           
            $('.full-day-form').show();
            $('.half-day-form').hide();
        break;
        case '2':
        
            $('.full-day-form').hide();
            $('.half-day-form').show();
        break;
        case '3':
            
            $('.full-day-form').hide();
            $('.half-day-form').show();
        break;
        default:
            
            $('.full-day-form').show();
            $('.half-day-form').hide();
        break;
        }
        
    }
    $('#kategoriCuti').change(function(e){
        paparForm($(this).val());

    console.log('Value : ' + $(this).val());
    });

";
$this->registerJs($js);

?>