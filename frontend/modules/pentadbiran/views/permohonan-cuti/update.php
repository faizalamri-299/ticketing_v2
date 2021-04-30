<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\PermohonanCuti */

$this->title = 'Kemaskini Maklumat Permohonan Cuti';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Permohonan Cuti', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>
<div class="permohonan-cuti-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
