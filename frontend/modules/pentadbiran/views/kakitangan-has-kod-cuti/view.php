<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KakitanganHasKodCuti */

$this->title = 'Maklumat Cuti';
$this->params['breadcrumbs'][] = ['label' => 'Senarai Cuti Kakitangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kakitangan-has-kod-cuti-view">
    <div class="card-box">
       <?= DetailView::widget([
            'model' => $model,
            'striped' => false,
            'bordered' => false,
            'condensed' => 'false',
            'labelColOptions' => [
                'style' => 'border:0; text-align:left;'
            ],
            'hAlign' => 'left',
            'vAlign' => 'top',
            'valueColOptions' => [
                'style' => 'border: 0;  text-align : left;'
            ],
            'attributes' => [
                //'id',
                [
                    'label' => 'No Kakitangan',
                    'value' => $model->kakitangan->kakitanganHasJawatan->kajt_mod_no_kakitangan,
                ],
                [
                    'label' => 'Nama Kakitangan',
                    'value' => $model->kakitangan->ma_mod_nama_penuh,
                ],
                [
                    'label' => 'Jenis Cuti',
                    'value' => $model->kodCuti->mod_jenis,
                ],
                'makc_mod_tahun',
                'makc_mod_jumlah_cuti',
                'makc_sys_baki_cuti',
            ],
        ]) ?>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <?= Html::a('Kemaskini', ['update', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
