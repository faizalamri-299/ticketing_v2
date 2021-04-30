<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\pentadbiran\models\KpKlinikPanelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kp Klinik Panels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kp-klinik-panel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Kp Klinik Panel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kp_mod_nama',
            'kp_mod_no_syarikat',
            'kp_mod_no_telefon',
            'kp_mod_emel',
            //'kp_mod_alamat1',
            //'kp_mod_alamat2',
            //'kp_mod_poskod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
