<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use common\components\BitGridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\DdDokumenDigitalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dokumen Digital';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dd-dokumen-digital-index">
    <div class="card-box">

    <p>
        <?= Html::a('Pendaftaran Dokumen Digital', ['create'], ['class' => 'btn btn-outline-primary btn-rounded btn-bordered waves-effect width-md waves-light']) ?>
    </p>

         <div class="row">
            <div class="col-md-12">
            <!-- Portlet card -->
                <div class="card">
                    <div class="card-header bg-blue text-white" id="accordion">
                        <div class="card-widgets">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="mdi mdi-minus"></i>
                            </a>
                        </div>

                        <h5 class="card-title mb-0 text-white">Carian</h5>
                    </div>

                    <div id="collapseOne" class="panel-collapse collapse <?= isset($_GET['DokumenDigitalSearch']) ? 'in' : '' ?>" role="tabpanel">
                        <div class="card-body">
                            <?= $this->render('_search',[
                                'model' => $searchModel,
                            ]); ?>
                        </div>
                    </div>   
                </div> <!-- end card-->
            </div><!-- end col -->
        </div>

        <?= BitGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'attribute'=>'dd_fk_kod_jenis_dokumen_id',
                    'value'=>'jenisDokumen.mod_keterangan',
                ],
                
                'dd_mod_tajuk_dokumen',
                'dd_mod_no_rujukan',
                'dd_mod_dokumen_daripada',
                'dd_mod_dokumen_kepada',
                [
                    'attribute'=>'dd_mod_tarikh_terima',
                    'value'=>'infoTarikhTerima',
                ],

                [
                    'attribute'=>'dd_mod_tarikh_serah',
                    'value'=>'infoTarikhSerah',
                ],
                'dd_mod_dokumen',

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
</div>
