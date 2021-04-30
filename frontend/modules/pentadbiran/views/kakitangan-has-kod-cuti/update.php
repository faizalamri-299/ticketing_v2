<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KakitanganHasKodCuti */

$this->title = 'Kemaskini Maklumat Cuti ' . $model->kakitangan->kakitanganHasJawatan->kajt_mod_no_kakitangan;
$this->params['breadcrumbs'][] = ['label' => 'Senarai Cuti Kakitangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kakitangan->kakitanganHasJawatan->kajt_mod_no_kakitangan, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>
<div class="kakitangan-has-kod-cuti-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
