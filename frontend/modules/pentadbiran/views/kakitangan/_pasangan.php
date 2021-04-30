<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $modelPsg frontend\modules\pentadbiran\models\KodJenisDokumen */

$this->title = 'Pendaftaran Maklumat Pasangan';

?>
<div class="maklumat-pasangan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($modelPsg, 'mp_mod_nama')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-6">
                    <?= $form->field($modelPsg, 'mp_mod_tarikh_lahir')->widget(DateControl::classname(), [
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
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($modelPsg, 'mp_mod_no_kp')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-6">
    				<?= $form->field($modelPsg, 'mp_mod_warganegara')->dropDownList($modelPsg->dataWarganegara(),[
                     'class' => 'form-control','prompt' => '--SILA PILIH--']) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($modelPsg, 'mp_mod_pekerjaan')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-6">
    				<?= $form->field($modelPsg, 'mp_mod_nama_majikan')->textInput(['maxlength' => true]) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-4">
    				<?= $form->field($modelPsg, 'mp_mod_alamat_majikan1')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-4">
    				<?= $form->field($modelPsg, 'mp_mod_alamat_majikan2')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-4">
    				<?= $form->field($modelPsg, 'mp_mod_poskod')->textInput(['maxlength' => true]) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($modelPsg, 'mp_mod_no_hp')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-6">
    				<?= $form->field($modelPsg, 'mp_mod_no_pejabat')->textInput(['maxlength' => true]) ?>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= Html::a('<< Kembali', ['create', 'idKa' => $idKa, 'tab' => 1], ['class' => 'btn btn-secondary waves-effect width-md waves-light']); ?>
                <?= Html::submitButton('Simpan' ,['create', 'idKa' => $idKa, 'class' => 'btn btn-primary waves-effect width-md waves-light pull-right']); ?>
                
            </div>
        </div>
        <div class="col-md-6 text-right">
            <div class="form-group">
                <?= Html::a('Seterusnya >>', ['create', 'idKa' => $idKa, 'tab' => 3], ['class' => 'btn btn-secondary waves-effect width-md waves-light']); ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
