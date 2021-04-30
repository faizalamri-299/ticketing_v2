<?php
use kartik\detail\DetailView;
use yii\helpers\Html;

use frontend\modules\pentadbiran\models\PermohonanCuti;
?>

    <div class="card-box">
        <div class="permohonan-cuti-modal">
            <div style="text-align: right;">
            <h4>
                <?= DetailView::widget([
                    'model' => $maklumat,
                    'striped' => false,
                    'bordered' => false,
                    'condensed' => true,
                    'labelColOptions' => [
                        'style' => 'border: 0; width: 20%;',
                    ],
                    'hAlign' => 'left',
                    'vAlign' => 'top',
                    'valueColOptions' => [
                        'style' => 'border: 0;'
                    ],
                    'attributes' => [
                        [
                        'label'=>'',
                        'attribute' => 'infoStatusCuti',
                        'format' => 'html',
                        'filter' => [0 => 'Dalam Prosess', 
                                    1 => 'Disokong',
                                    2 => 'Tidak Disokong',
                                    3 => 'Sah',
                                    4 => 'Tidak Sah',
                                    5 => 'Lulus',
                                    6 => 'Tidak Lulus',
                                    7 => 'Pembatalan Cuti'],
                ],
            ],
        ]) ?></h4>
    </div>
                <div class="col-md-12">
                <?= DetailView::widget([
                    'model' => $maklumat,
                    'striped' => false,
                    'bordered' => false,
                    'condensed' => true,
                    'labelColOptions' => [
                        'style' => 'border: 0; width: 20%;',
                    ],
                    'hAlign' => 'left',
                    'vAlign' => 'top',
                    'valueColOptions' => [
                        'style' => 'border: 0;'
                    ],
                    'attributes' => [
                        'infoKakitangan',
                        'infoCuti',
                        'infoJenisCuti',
                        'pc_mod_tarikh_mula:date',
                        'pc_mod_tarikh_tamat:date',
                         'pc_sys_bil_cuti',
                         'pc_mod_keterangan',
                    ],
                ]) ?>
                 <div style="text-align: right;">
            <?= Html::a('Lihat Permohonan', ['/pentadbiran/permohonan-cuti/view', 'id' => $maklumat->id], ['class'=>'btn btn-outline-primary btn-rounded btn-bordered waves-effect width-md waves-light']) ?>
        </div>

        </div>
    </div>