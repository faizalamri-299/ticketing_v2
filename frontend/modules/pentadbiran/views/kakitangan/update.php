<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodJenisDokumen */

$this->title = 'Kemaskini Data Peribadi: ' . $model->ma_mod_nama_penuh;
$this->params['breadcrumbs'][] = ['label' => 'Data Peribadi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kod-jenis-dokumen-update">
	<div class="card-box">

    <?= $this->render('_peribadi', [
        'model' => $model,
    ]) ?>
    
    </div>
</div>
