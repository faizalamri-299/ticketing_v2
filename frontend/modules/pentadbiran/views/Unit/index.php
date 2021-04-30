<?php

use yii\helpers\Html;
use common\components\BitGridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\UnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-index">
    <div class ="card-box">

        <p>
            <?= Html::a('Create Unit', ['create'], ['class' => 'btn btn-success']) ?>
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
                'ut_mod_kod',
                'ut_mod_singkatan',
                'ut_mod_nama_unit',

                    ['class' => 'yii\grid\ActionColumn'
                ],
        ],

     ]); ?>
 </div>
</div>
