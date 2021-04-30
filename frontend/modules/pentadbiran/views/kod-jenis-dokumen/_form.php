<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodJenisDokumen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kod-jenis-dokumen-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-6">
    				<?= $form->field($model, 'mod_kod')->textInput(['maxlength' => true]) ?>
    			</div>
    			<div class="col-md-6">
    				<?= $form->field($model, 'mod_keterangan')->textInput(['maxlength' => true]) ?>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
