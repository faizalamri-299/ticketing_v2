<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\DetailView;
use yii\db\Query;
use yii\grid\GridView;
use kartik\datecontrol\DateControl;
use yii\data\ActiveDataProvider;
use common\components\BitGridView;
use frontend\modules\pentadbiran\models\AnakKakitangan;

/* @var $this yii\web\View */
/* @var $modelAnk frontend\modules\pentadbiran\models\KodJenisDokumen */

$dataProviderAnk = new ActiveDataProvider([
    'query' => frontend\modules\pentadbiran\models\AnakKakitangan::find()
    ->andWhere(['man_fk_kakitangan_id'=>$idKa]),
]);


$this->title = 'Pendaftaran Maklumat Peribadi';

?>
<div class="maklumat-peribadi-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($modelAnk, 'man_mod_nama')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-6">
    				<?= $form->field($modelAnk, 'man_mod_jenis_pengenalan')->dropDownList($modelAnk->dataJenisPengenalan(),[
                     'class' => 'form-control','prompt' => '--SILA PILIH--']) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($modelAnk, 'man_mod_no_pengenalan')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-6">
    				<?= $form->field($modelAnk, 'man_mod_umur')->textInput(['maxlength' => true]) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($modelAnk, 'man_mod_tarikh_lahir')->widget(DateControl::classname(), [
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
    			<div class="col-md-6">
    				<?= $form->field($modelAnk, 'man_mod_tempat_lahir')->textInput(['maxlength' => true]) ?>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($modelAnk, 'man_mod_jenis_status')->dropDownList($modelAnk->dataJenisStatus(),[
                     'class' => 'form-control','prompt' => '--SILA PILIH--']) ?>
    			</div>
    			<div class="col-md-6">
    				<?= $form->field($modelAnk, 'man_mod_nama_insitusi')->textInput(['maxlength' => true]) ?>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Tambah', ['class' => 'btn btn-success']) ?>
        <br><br>
    <h4 class="header-title">Senarai Anak</h4>
    <?= BitGridView::widget([
            'dataProvider' => $dataProviderAnk,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'man_mod_nama',
                // 'ma_mod_jawatan',
                // 'ma_mod_nama_penuh',
                ['class' => 'kartik\grid\ActionColumn',
                        'vAlign' => 'top',
                        // 'options' => ['style' => 'width:9%'],
                        'header' => 'Tindakan',
                        'template' => '{delete}',
                         'buttons' => [
                            'delete' => function ($url,$model, $key) {
                                return Html::a('<i class="fe-trash-2" style="font-size: 1.3em;"></i><span>', $url,
                                    [
                                        'title' => Yii::t('app', 'Padam'), 
                                        'data' => [
                                            'confirm'=>'Adakah anda pasti?', 
                                            'method' => 'post',
                                            'tooltip' => 'tooltip',  
                                            'pjax' => 0,
                                        ], 
                                    ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model) use ($flag) {
                            if($action === 'delete') {
                                return Url::toRoute(['delete-anak', 'id'=>$model->id]);
                            }
                        },   
                    ],
                ],]);
                ?>
                <hr/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= Html::a('<< Kembali', ['create', 'idKa' => $idKa, 'tab' => 2], ['class' => 'btn btn-secondary waves-effect width-md waves-light']); ?>
                            <?= Html::submitButton('Simpan' ,['create', 'idKa' => $idKa, 'class' => 'btn btn-primary waves-effect width-md waves-light pull-right']); ?>
                            
                        </div>
                    </div>
                <div class="col-md-6 text-right">
                    <div class="form-group">
                        <?= Html::a('Seterusnya >>', ['create', 'idKa' => $idKa, 'tab' => 4], ['class' => 'btn btn-secondary waves-effect width-md waves-light']); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>