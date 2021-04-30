<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use common\components\BitGridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\KodCutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kod Cuti';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card-box">
    <div class="kod-cuti-form">
        <div class="row">
        <div class="col-md-4">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'mod_jenis')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
        <?= $form->field($model, 'mod_keterangan')->textInput(['maxlength' => true]) ?>
        </div>
        </div>
        
        <div class="form-group" align="right">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <hr>
    <div class="kod-cuti-index">
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
                    ],        
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'mod_jenis',
                "mod_keterangan",

                ['class' => 'yii\grid\ActionColumn'],

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
