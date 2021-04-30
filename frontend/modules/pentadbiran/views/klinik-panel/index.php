<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\BitGridView;
//use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\KlinikPanelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Klinik Panel';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
            <div class="col-md-12">
            <!-- Portlet card -->
                <div class="card">
                    <div class="card-header bg-purple text-white" id="accordion">
                        <div class="card-widgets">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="mdi mdi-minus"></i>
                            </a>
                        </div>

                        <h5 class="card-title mb-0 text-white">Carian</h5>
                    </div>

                    <div id="collapseOne" class="panel-collapse collapse <?= isset($_GET['KlinikPanelSearch']) ? 'in' : '' ?>" role="tabpanel">
                        <div class="card-body">
                            <?= $this->render('_search',[
                                'model' => $searchModel,
                            ]); ?>
                        </div>
                    </div>   
                </div> <!-- end card-->
            </div><!-- end col -->
        </div>

<div class="card-box">
<div class="klinik-panel-index">
    <p>
        <?= Html::a('Daftar Klinik Panel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     <?= BitGridView::widget([
            'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'pjax' => true,
                'pjaxSettings' => [
                    'options' => [
                        'id' => 'gv-pjax-senarai-kenderaan',
                        'enablePushState' => false                    
                    ]
                ],        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'kp_mod_nama',
            //'kp_mod_no_syarikat',
            'kp_mod_no_telefon',
            //'kp_mod_emel',
            [
                    'attribute'=>'kp_mod_alamat1',
                    'value'=>'InfoAlamat',
            ],
            [
                    'attribute'=>'kp_mod_daerah',
                    'value'=>'InfoDaerah',
            ],
            [
                    'attribute'=>'kp_mod_negeri',
                    'value'=>'InfoNegeri',
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


</div>
