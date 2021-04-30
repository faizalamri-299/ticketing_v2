<?php

use yii\helpers\Html;
use common\components\BitGridView;
use yii\helpers\Url;
use frontend\modules\pentadbiran\models\KakitanganHasJawatan;
//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\KlinikPanelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Kakitangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Kakitangan-index">
 <div class ="card-box">
    <p>
        <?= Html::a('Daftar Kakitangan Baru', ['create'], ['class' => 'btn btn-outline-primary btn-rounded btn-bordered waves-effect width-md waves-light']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 

    ?>

    <?= BitGridView::widget([
            'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'pjax' => true,
                'pjaxSettings' => [
                    'options' => [
                        'id' => 'gv-pjax-senarai-kenderaan',
                        'enablePushState' => false                    
                    ]
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'kajt_mod_no_kakitangan',
                    'value' => 'kakitanganHasJawatan.kajt_mod_no_kakitangan',

                ],   
                'ma_mod_nama_penuh',
                [
                    'attribute' => 'infoUnit',
                    'value' => 'kakitanganHasJawatan.infoUnit',
                ],  
                [
                    'attribute' => 'infoJawatan',
                    'value' => 'kakitanganHasJawatan.infoJawatan',
                ],      
                'infoTarikhLahir',
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
                             return Url::toRoute(['create', 'id'=>$model['id']]);
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
