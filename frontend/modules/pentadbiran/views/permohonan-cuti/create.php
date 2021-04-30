<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\PermohonanCuti */

$this->title = 'Permohonan Cuti';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-cuti-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
