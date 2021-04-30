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
                    <?= $form->field($model, 'ma_mod_no_kp') ?>              
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
