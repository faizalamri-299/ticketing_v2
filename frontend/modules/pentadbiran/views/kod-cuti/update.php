<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodCuti */

$this->title = 'Update Kod Cuti: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kod Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kod-cuti-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
