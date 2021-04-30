<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\components\BitGridView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\KakitanganHasKodCutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Cuti Kakitangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--collapse button for form Tambah Jumlah Cuti Kakitangan-->  
<div class ="card-box">
    <div class="kakitangan-has-kod-cuti-index">
         <p>
                <?= Html::a('Tambah Cuti Kakitangan', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]);
        echo BitGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'makc_fk_maklumat_anggota_id', 
                'label' => 'No Kakitangan',
                'width' => '500px',
                'value' => function ($model, $key, $index, $widget) { 
                    return $model->kakitangan->kakitanganHasJawatan->kajt_mod_no_kakitangan;
                },
                'group' => true,  // enable grouping
                'groupOddCssClass' => 'kv-row',  // configure odd group cell css class
                'groupEvenCssClass' => 'kv-row', // configure even group cell css class
            ],
            [
                'attribute' => 'makc_fk_maklumat_anggota_id', 
                'width' => '500px',
                'value' => function ($model, $key, $index, $widget) { 
                    return $model->kakitangan->ma_mod_nama_penuh;
                },
                'group' => true,  // enable grouping
                //'groupedRow' => true,          // move grouped column to a single grouped row
                'groupOddCssClass' => 'kv-row',  // configure odd group cell css class
                'groupEvenCssClass' => 'kv-row', // configure even group cell css class
                'subGroupOf' => 1 // supplier column index is the parent group
            ],
            ['class' => 'kartik\grid\ActionColumn',
                'vAlign' => 'top',
                // 'options' => ['style' => 'width:9%'],
                'header' => 'Tindakan',
                'template' => '{view}',
                 'buttons' => [
                    'view' => function ($url,$model, $key) {
                            return Html::a('<i class="fe-eye" style="font-size: 1.3em;"></i><span>', $url,
                            [
                                'title' => Yii::t('app', 'Maklumat'), 
                                'data-pjax' => 0,
                                'data-tooltip'=>"tooltip",
                            ]);
                        },
                ],
                'urlCreator' => function ($action, $model) {
                    if ($action === 'view') {
                         return Url::toRoute(['view-kakitangan', 'id'=>$model['makc_fk_maklumat_anggota_id']]);
                    }
                     
                },   
            ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
</div>
