<?php

use common\components\BitGridView;
// use kartik\widgets\ActiveForm;
// use kartik\widgets\SwitchInput;
// use yii\bootstrap4\Modal;
// use yii\data\ActiveDataProvider;
// use yii\filters\AccessControl;
// use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
// use yii\web\Controller;
// use yii\web\NotFoundHttpException;
// use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\KodJenisDokumenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pendaftaran Jenis Dokumen';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>
<div class="kod-jenis-dokumen-form">
    <div class="card-box">
        <div class="row">
            <div class="col-md-12">
                <form class="form-inline">
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'mod_kod')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-8">
                        <?= $form->field($model, 'mod_keterangan')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                    <div class="form-group">
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success ']) ?>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<div class="kod-jenis-dokumen-index">
    <div class="card-box">

    <p>
        <?= Html::a('Pendaftaran Kod Jenis Dokumen', ['create'], ['class' => 'btn btn-outline-primary btn-rounded btn-bordered waves-effect width-md waves-light']) ?>
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
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'mod_kod',
                'mod_keterangan',

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
    </div>
</div>
