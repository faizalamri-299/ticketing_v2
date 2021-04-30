<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\Tuntutan */

$this->title = 'Update Tuntutan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tuntutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tuntutan-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
