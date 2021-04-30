<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KlinikPanel */

$this->title = 'Pendaftaran Klinik Panel';
$this->params['breadcrumbs'][] = ['label' => 'Klinik Panel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="klinik-panel-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
