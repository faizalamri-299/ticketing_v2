<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodTuntutan */

$this->title = 'Daftar Kod Tuntutan';
$this->params['breadcrumbs'][] = ['label' => 'Kod Tuntutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-box">
<div class="kod-tuntutan-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>