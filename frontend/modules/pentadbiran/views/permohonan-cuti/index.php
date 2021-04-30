<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\components\BitGridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\PermohonanCutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Permohonan Cuti';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="card-box">
        <div class="permohonan-cuti-index">
            <p>
                <?= Html::a('Permohonan Cuti', ['create'], ['class' => 'btn btn-primary']) ?>
            </p>
             <?php Pjax::begin(); ?>
             <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= BitGridView::widget([

            'dataProvider' => $dataProvider,

            'filterModel' => $searchModel,
            //'panel' => ['type' => 'primary', 'heading' => 'Permohonan Cuti Kakitangan'],
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                [
                'attribute'=>'pc_fk_maklumat_anggota_id',
                'value'=>'kakitangan.ma_mod_nama_penuh',
                ],
                [
                'label' => 'Kategori Cuti',
                'attribute'=>'pc_fk_kod_cuti_id',
                'value'=>'kakitanganHasKodCuti.kodCuti.mod_jenis',
                ],
                //'infoCuti',
                [
                'attribute'=>'pc_mod_tarikh_mula',
                 'format'=>['date','php:d-M-Y']
                ],
                [
                'attribute'=>'pc_mod_tarikh_tamat',
                 'format'=>['date','php:d-M-Y']
                ],
                
                'pc_sys_bil_cuti',
                  [
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

                [
                    'class' => 'kartik\grid\ActionColumn',
                    'vAlign' => 'top',
                    // 'options' => ['style' => 'width:9%'],
                    'header' => 'Tindakan',
                    'template' => '{view} {update} {delete}',
                     'buttons' => [
                        'view' => function ($url,$model, $key) {
                                return Html::a('<i class="fe-eye" style="font-size: 1.3em;"></i><span>', $url,
                                [
                                    'title' => Yii::t('app', 'Maklumat'), 
                                    'data-pjax' => 0,
                                    'data-tooltip'=>"tooltip",
                                ]);
                            },
                        'update' => function ($url,$model)  {
                            return Html::a('<i class="fe-edit" style="font-size: 1.3em;"></i><span>', $url,
                                [
                                    'title' => Yii::t('app', 'Kemaskini'),
                                    'data-pjax' => 0,
                                    'data-tooltip'=>"tooltip",
                                ]);
                        },
                        'delete' => function ($url,$model, $key) {
                            return Html::a('<i class="fe-trash-2" style="font-size: 1.3em;"></i><span>', $url,
                                [
                                    'title' => Yii::t('app', 'Padam'), 
                                    'data' => [
                                        'confirm'=>'Adakah anda pasti?', 
                                        'method' => 'post',
                                        'tooltip' => 'tooltip',  
                                        'pjax' => 0,
                                    ], 
                                ]);
                        },
                    ],
                    'urlCreator' => function ($action, $model) {
                        if ($action === 'view') {
                             return Url::toRoute(['view', 'id'=>$model['id']]);
                        }
                         if ($action === 'update') {
                             return Url::toRoute(['update', 'id'=>$model['id']]);
                        }
                        if($action === 'delete') {
                            return Url::toRoute(['delete', 'id'=>$model['id']]);
                        }
                    },   
                ],
            ],
        ]); ?>
         <?php Pjax::end(); ?>

    </div>
</div>
