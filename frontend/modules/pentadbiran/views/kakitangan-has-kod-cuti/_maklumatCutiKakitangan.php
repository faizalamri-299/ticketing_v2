<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\components\BitGridView;
use kartik\detail\DetailView;
use frontend\modules\pentadbiran\models\KakitanganHasKodCuti;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\KakitanganHasKodCutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maklumat Cuti ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="maklumat-kakitangan-view">

        <div class="row">
            <div class="col-md-3">
                <div class="card-box h-100">
                    <div class="col-md-12">
                        <a href="<?= $model->kakitangan->getPathPhotoMedium(); ?>" data-lightbox="gallery-set" data-title="Click the right half of the image to move forward.">
                        <img src="<?= $model->kakitangan->getPathPhotoMedium(); ?>" alt="" class="card-img-top img-fluid"/>
                        <br>
                        </a> 
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card-box h-100">
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
                                [
                                    'label' => 'No Kakitangan',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->kajt_mod_no_kakitangan,
                                ],
                                [
                                    'label' => 'Nama Kakitangan',
                                    'value' => $model->kakitangan->ma_mod_nama_penuh,
                                ],
                                [
                                    'label' => 'No Kad Pengenalan',
                                    'value' => $model->kakitangan->ma_mod_no_kp,
                                ],
                                [
                                    'label' => 'Eksekutif',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->kajt_flag_eksekutif,
                                ],
                                [
                                    'label' => 'Anggota/Kakitangan',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->kajt_mod_kategori_anggota,
                                ],
                                [
                                    'label' => 'Unit',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->jawatan->unit->ut_mod_nama_unit,
                                ],
                                [
                                    'label' => 'Jawatan',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->jawatan->jt_mod_nama_jawatan,
                                ],
                            ],
                    ]) ?> <br>
                </div> 
            </div>
        </div>
        <hr>
        <div class="card-box">
        <h4 class="header-title">Senarai Maklumat Cuti</h4> <br>
            <div class="kakitangan-has-kod-cuti-index">
                    
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]);

             echo BitGridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
                    'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'makc_mod_tahun', 
                        'label' => 'Tahun',
                        'width' => '250px',
                        'value' => function ($model, $key, $index, $widget) { 
                            return $model->makc_mod_tahun;
                        },
                        'group' => true,  // enable grouping
                        'groupOddCssClass' => 'kv-row',  // configure odd group cell css class
                        'groupEvenCssClass' => 'kv-row', // configure even group cell css class
                        // 'subGroupOf' => 1 // supplier column index is the parent group
                    ],
                    [
                        'attribute'=>'makc_fk_kod_cuti_id',
                        'value'=>'kodCuti.mod_jenis',
                    ],
                    'makc_mod_jumlah_cuti',
                    
                    // // 'fk_makc_kod_cuti_id',
                   // 'makc_mod_tahun',
                    //'makc_mod_jumlah_cuti',
                    'makc_sys_baki_cuti',
                    // //'makc_mod_status',

                     ['class' => 'kartik\grid\ActionColumn',
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

                    // ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
            </div>
        </div>
    
</div>
