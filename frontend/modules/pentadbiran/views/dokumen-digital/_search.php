<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\DdDokumenDigitalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dd-dokumen-digital-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

   <div class="row">
       <div class="col-md-12">
           <div class="row">
               <div class="col-md-3">
                    <?= $form->field($model, 'dd_fk_kod_jenis_dokumen_id') ?>              
                </div>
                <div class="col-md-9">
                     <?= $form->field($model, 'dd_mod_tajuk_dokumen') ?>
                </div>
           </div>
           <div class="row">
               <div class="col-md-4">
                     <?= $form->field($model, 'dd_mod_no_rujukan') ?>
                </div>
                <div class="col-md-4">
                     <?= $form->field($model, 'dd_mod_dokumen_daripada') ?>
                </div>
                <div class="col-md-4">
                     <?= $form->field($model, 'dd_mod_dokumen_kepada') ?>
                </div>
           </div>
           <div class="row">
               <div class="col-md-6"><?= $form->field($model, 'dd_mod_tarikh_terima')->widget(DateTimePicker::class,[
                    'options' => ['placeholder' => '--Sila Pilih Tarikh Terima--'],
                    'pluginOptions' => [
                    //'format' => 'dd/mm/yyyy H:i:s',
                    'todayHighlight' => true]]);?>
               </div>
               <div class="col-md-6"><?= $form->field($model, 'dd_mod_tarikh_serah')->widget(DateTimePicker::class,[
                    'options' => ['placeholder' => '--Sila Pilih Tarikh Serah--'],
                    'pluginOptions' => [
                    //'format' => 'dd/mm/yyyy H:i:s',
                    'todayHighlight' => true]]);?>
               </div>
           </div>
       </div>
   </div>

    


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
