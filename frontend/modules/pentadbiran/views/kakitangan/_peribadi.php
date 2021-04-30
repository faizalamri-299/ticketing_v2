<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;
use frontend\modules\pentadbiran\models\Kakitangan;


$kodDaerah = frontend\modules\pentadbiran\models\Kakitangan::getDropDownKodDaerah();
$kodNegeri = frontend\modules\pentadbiran\models\Kakitangan::getDropDownKodNegeri(); 
$kodUnit = frontend\modules\pentadbiran\models\Kakitangan::getKodUnit(); 

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodJenisDokumen */

$this->title = 'Pendaftaran Maklumat Peribadi';

?>
<div class="maklumat-peribadi-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($model, 'ma_mod_nama_penuh')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-6">
                <?= $form->field($model, 'ma_mod_tarikh_lahir')->widget(DateControl::classname(), [
                    'type' => DateControl::FORMAT_DATE,
                    'ajaxConversion'=>true,
                    'id' => 'Tarikh',
                    'options' => [
                        'pluginOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                    ]
                ]); ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-3">
    				<?= $form->field($model, 'ma_mod_no_kp')->textInput(['maxlength' => true,'id'=>'noIC']) ?>
    			</div>
    			<div class="col-md-3">
    				<?= $form->field($model, 'ma_mod_status_perkahwinan')->dropDownList($model->dataStatusPerkahwinan(),[
                     'class' => 'form-control','prompt' => '--SILA PILIH--']) ?>
    			</div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ma_mod_bangsa')->dropDownList($model->dataBangsa(),[
                     'class' => 'form-control','prompt' => '--SILA PILIH--']) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'ma_mod_agama')->dropDownList($model->dataAgama(),[
                     'class' => 'form-control','prompt' => '--SILA PILIH--']) ?>
                </div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($model, 'ma_mod_alamat1')->textInput(['maxlength' => true,'id'=>'alamat']) ?>
    			</div>
    			<div class="col-md-6">
    				<?= $form->field($model, 'ma_mod_alamat2')->textInput(['maxlength' => true,'id'=>'alamat2']) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-4">
    				<?= $form->field($model, 'ma_mod_poskod')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-4">
    				<?= $form->field($model, 'ma_mod_daerah')->dropDownList($kodDaerah, 
                        ['id' => 'keterangan', 'prompt'=>'--SILA PILIH--']) ?>
    			</div>
    			<div class="col-md-4">
    				<?= $form->field($model, 'ma_mod_negeri')->dropDownList($kodNegeri, 
                        ['id' => 'keterangan', 'prompt'=>'--SILA PILIH--']) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-4">
    				<?= $form->field($model, 'ma_mod_warganegara')->dropDownList($model->dataWarganegara(),[
                     'class' => 'form-control','prompt' => '--SILA PILIH--']) ?>
    			</div>
    			<div class="col-md-4">
    				<?= $form->field($model, 'ma_mod_kelayakan_tertinggi')->dropDownList($model->dataKelayakan(),[
                     'class' => 'form-control','prompt' => '--SILA PILIH--']) ?>
    			</div>
    			<div class="col-md-4">
    				<?= $form->field($model, 'ma_mod_bidang')->textInput(['maxlength' => true]) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-3">
    				<?= $form->field($model, 'ma_mod_no_cukai_pendapatan')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-3">
    				<?= $form->field($model, 'ma_mod_no_kwsp')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-3">
    				<?= $form->field($model, 'ma_mod_no_akaun_bank')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-3">
    				<?= $form->field($model, 'ma_mod_bank')->dropDownList($model->dataNamaBank(),[
                     'class' => 'form-control','prompt' => '--SILA PILIH--']) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-4">
    				<?= $form->field($model, 'ma_mod_no_hp')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-4">
    				<?= $form->field($model, 'ma_mod_no_telefon_rumah')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-4">
    				<?= $form->field($model, 'ma_mod_email')->textInput(['maxlength' => true]) ?>
    			</div>
    		</div>
    	</div>
        <div class="col-md-3">
                <?= $form->field($model, 'tempImage')->widget(FileInput::classname(), [
                    'options'=>['accept'=>'image/*', 'multiple' => false],
                    'pluginOptions'=>[
                        // 'allowedFileExtensions'=>['jpg','jpeg','png'],
                        // 'showUpload' => false,
                        // 'showRemove' => true,
                        'showCaption' => false,
                        'showRemove' => true,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-info btn-block',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' =>  'Select Photo',
                        'initialPreview'=> !empty($model->ma_mod_gambar) ?
                            Html::img(Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/images/kakitangan/' . $model->id . '/m_' . $model->ma_mod_gambar, ['width'=>150])
                        : '' ,
                    ],
                ]); ?>
            </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= Html::submitButton('Simpan' ,['create', 'idKa' => $idKa, 'class' => 'btn btn-primary waves-effect width-md waves-light pull-right']); ?>
                
            </div>
        </div>
        <div class="col-md-6 text-right">
            <div class="form-group">
                <?= Html::a('Seterusnya >>', ['create', 'idKa' => $idKa, 'tab' => 2], ['class' => 'btn btn-secondary waves-effect width-md waves-light']); ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>


