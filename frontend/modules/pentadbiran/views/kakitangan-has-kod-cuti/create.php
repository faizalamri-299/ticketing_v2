<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KakitanganHasKodCuti */

$this->title = 'Tambah Jumlah Cuti Kakitangan';
$this->params['breadcrumbs'][] = ['label' => 'Jumlah Cuti Kakitangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kakitangan-has-kod-cuti-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
