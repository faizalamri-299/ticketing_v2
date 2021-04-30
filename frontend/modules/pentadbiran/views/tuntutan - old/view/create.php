<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\Tuntutan */

$this->title = 'Tuntutan Baru';
$this->params['breadcrumbs'][] = ['label' => 'Tuntutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tuntutan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <!-- <?= $this->render('_formElaunPerjalanan', [
        'model' => $model,
    ]) ?> -->
</div>