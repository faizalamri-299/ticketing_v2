<?php

use yii\helpers\Html;
use kartik\detail\DetailView;


/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\DdDokumenDigital */


\yii\web\YiiAsset::register($this);
?>

<div class="dd-maklumat-peribadi-view">
    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'enableEditMode' => false,
                'striped' => false,
                'bordered' => false,
                'condensed' => true,
                'labelColOptions' => [
                    'style' => 'border: 0;',
                    ],
                'hAlign' => 'left',
                'vAlign' => 'top',
                'valueColOptions' => [
                    'style' => 'border: 0;',
                    ],
                'attributes' => [
                    //'id',
                    'ma_mod_nama_penuh',
                    'infoTarikhLahir',
                    'ma_mod_no_kp',
                    'ma_mod_status_perkahwinan',
                    'ma_mod_bangsa',
                    'ma_mod_agama',
                    'infoAlamat',
                    'ma_mod_email',

                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'enableEditMode' => false,
                'striped' => false,
                'bordered' => false,
                'condensed' => true,
                'labelColOptions' => [
                'style' => 'border: 0;',
                    ],
                'hAlign' => 'left',
                'vAlign' => 'top',
                'valueColOptions' => [
                'style' => 'border: 0;',
                    ],
                'attributes' => [
                    'ma_mod_warganegara',
                    'ma_mod_kelayakan_tertinggi',
                    'ma_mod_bidang',
                    'ma_mod_no_cukai_pendapatan',
                    'ma_mod_no_kwsp',
                    'ma_mod_no_akaun_bank',
                    'ma_mod_bank',
                    'ma_mod_no_hp',
                    'ma_mod_no_telefon_rumah',
                ],
            ]) ?>
        </div>
        
    </div>
</div>


