<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\BitGridView;
use yii\web\JsExpression;
use yii\helpers\Json;
use yii2fullcalendar\models\Event;
use frontend\assets\CalendarAsset;
CalendarAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\TuntutanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tuntutan';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card-box">
<div class="tuntutan-index">


    <p>
        <?= Html::a('Tuntutan Baru', ['create'], ['class' => 'btn btn-outline-primary btn-rounded btn-bordered waves-effect width-md waves-light']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= BitGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'pjaxSettings' => [
            'options' => [
                'id' => 'gv-pjax-senarai-kenderaan',
                'enablePushState' => false                    
        ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'makt_fk_kategori_tuntutan',
                'value'=>'kategori.kk_mod_kategori',
                'filter' => ['1' => 'Elaun Harian', 
                             '2' => 'Elaun Perjalanan', 
                             '3' => 'Elaun Pengangkutan Udara', 
                             '4' => 'Elaun Penginapan',
                             '5' => 'Elaun Mesyuarat',
                             '6' => 'Elaun Baju Panas'],
            ],
            [
                'attribute'=>'makt_fk_kod_tuntutan_id',
                'value'=>'kodTuntutan.mod_jenis_tuntutan',
            ],
            [
                'attribute'=>'makt_fk_maklumat_anggota_id',
                'value'=>'namaKakitangan.ma_mod_nama_penuh',
            ],
            // 'makt_sys_user_masuk',
            // 'makt_sys_tarikh_masuk',
            // 'makt_sys_user_kemaskini',
            // 'makt_sys_tarikh_kemaskini',
             'infoMasa',
             'makt_mod_butiran_tuntutan',

            // 'makt_mod_tempat_dituju',
            // 'makt_mod_butiran_perjalanan',
            // 'makt_mod_waktu_tiba_pejabat',
            // 'makt_mod_waktu_bertolak',
            // 'makt_mod_waktu_balik',
            // 'makt_mod_jumlah_jam',
            // 'makt_mod_hitungan_km',
            // 'makt_mod_resit',
            
            [
                'attribute' => 'infoStatus',
                'format' => 'html',
                'filter' => [0 => 'Baru', 
                             1 => 'Semakan',
                             2 => 'Lulus',
                             3 => 'Gagal',],
            ],

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
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
</div>

