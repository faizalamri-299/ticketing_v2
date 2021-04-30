<?php

use yii\helpers\Html;
use common\components\BitGridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\JawatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jawatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jawatan-index">

    <div class ="card-box">

        <p>
            <?= Html::a('Create Jawatan', ['create'], ['class' => 'btn btn-outline-primary btn-rounded btn-bordered waves-effect width-md waves-light']) ?>
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
                'jt_fk_ut_id',
                'jt_mod_kod',
                'jt_mod_nama_jawatan',
                'jt_mod_ringkasan_peranan',

                    ['class' => 'yii\grid\ActionColumn'
                ],
        ],

     ]); ?>

    </div>

</div>
