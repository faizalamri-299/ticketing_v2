<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\components\BitGridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\KodTuntutanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kod Tuntutan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card-box">
    <div class="kod-tuntutan-create">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
    
<div class="card-box">
<div class="kod-tuntutan-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);

    echo BitGridView::widget([

    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'panel' => ['type' => 'primary', 'heading' => 'Jadual Tuntutan'],
    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'mod_kategori',
            'width' => '310px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->mod_kategori;
            },
            'group' => true,  // enable grouping
            'groupedRow' => true,                    // move grouped column to a single grouped row
            'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
            'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class

        ],
        [
            'attribute' => 'mod_kod_tuntutan', 
            'width' => '100px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->mod_kod_tuntutan;
            },
            'group' => true,  // enable grouping
            'groupOddCssClass' => 'kv-row',  // configure odd group cell css class
            'groupEvenCssClass' => 'kv-row', // configure even group cell css class
            'subGroupOf' => 1, // supplier column index is the parent group
            
        ],
        [
            'attribute' => 'mod_jenis_tuntutan', 
            'width' => '250px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->mod_jenis_tuntutan;
            },
            'group' => true,  // enable grouping
            'groupOddCssClass' => 'kv-row',  // configure odd group cell css class
            'groupEvenCssClass' => 'kv-row', // configure even group cell css class
            'subGroupOf' => 1 // supplier column index is the parent group
        ],
        [
            'attribute' => 'mod_keterangan', 
            'width' => '250px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->mod_keterangan;
            },
           
            'group' => true,  // enable grouping
            'groupOddCssClass' => 'kv-row',  // configure odd group cell css class
            'groupEvenCssClass' => 'kv-row', // configure even group cell css class
            'subGroupOf' => 1 // supplier column index is the parent group
        ],
        [
            'attribute' => 'mod_penuntut', 
            'width' => '250px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->mod_penuntut;
            },
            
            'group' => true,  // enable grouping
            'groupOddCssClass' => 'kv-row',  // configure odd group cell css class
            'groupEvenCssClass' => 'kv-row', // configure even group cell css class
            'subGroupOf' => 1 // supplier column index is the parent group
        ],
        [
            'attribute' => 'mod_kadar', 
            'width' => '250px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->mod_kadar;
            },
            
            'group' => true,  // enable grouping
            'groupOddCssClass' => 'kv-row',  // configure odd group cell css class
            'groupEvenCssClass' => 'kv-row', // configure even group cell css class
            'subGroupOf' => 1 // supplier column index is the parent group
        ],
        [
            'attribute' => 'mod_nilaian', 
            'width' => '250px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->mod_nilaian;
            },
            
            'group' => true,  // enable grouping
            'groupOddCssClass' => 'kv-row',  // configure odd group cell css class
            'groupEvenCssClass' => 'kv-row', // configure even group cell css class
            'subGroupOf' => 1 // supplier column index is the parent group
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
]);

     ?>

</div>
</div>
