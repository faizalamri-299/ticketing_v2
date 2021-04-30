<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodCuti */

$this->title = 'Tambah Kod Cuti';
$this->params['breadcrumbs'][] = ['label' => 'Kod Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kod-cuti-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
