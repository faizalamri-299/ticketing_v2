<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodCuti */

$this->title = $model->mod_jenis;
$this->params['breadcrumbs'][] = ['label' => 'Kod Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kod-cuti-view">
    <div class="card-box">
        <h4>MAKLUMAT KOD CUTI</h4>
        <hr>
    <?= DetailView::widget([
        'model' => $model,
        'striped' => false,
        'bordered' => false,
        'condensed' => true,
         'labelColOptions' => [
               'style' => 'border: 0; width: 20%;', ],
        'hAlign' => 'left',
        'vAlign' => 'top',
        'valueColOptions' => [
         'style' => 'border: 0;'
                    ],

        'attributes' => [
            'mod_jenis',
            'mod_keterangan',
        ],
    ]) ?>
    <hr>
    <div class="update" align="left">
    <p>
        <?= Html::a('Kemaskini', ['update', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
    </p>
</div>
</div>
</div>
