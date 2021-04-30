<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
//use $kodDaerah = \frontend\models\KodDaerah::getKodDaerahList(); 

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KlinikPanel */

$this->title = $model->kp_mod_nama;
$this->params['breadcrumbs'][] = ['label' => 'Klinik Panel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="klinik-panel-view">
    <div class="card-box">
         <h4>Maklumat Klinik Panel</h4>
         <hr>
    <?= DetailView::widget([
                    'model' => $model,
                    'striped' => false,
                    'bordered' => false,
                    'condensed' => true,
                    'labelColOptions' => [
                        'style' => 'border: 0; width: 20%;',
                    ],
                    'hAlign' => 'left',
                    'vAlign' => 'top',
                    'valueColOptions' => [
                        'style' => 'border: 0;'
                    ],

        'attributes' => [
            // 'id',
            'kp_mod_nama',
            'kp_mod_no_syarikat',
            'kp_mod_no_telefon',
            'kp_mod_emel',
            'InfoAlamat',
        ],
    ]) ?>
    <hr>
    <div class="row">
    <div class="col-md-6 text-left">
    <p>
        <?= Html::a('Kemaskini', ['update', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
    </p>
    </div>

    <div class="col-md-6 text-right">
     <p>
        <?= Html::a('Padam', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Anda pasti ingin padam maklumat ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
</div>
</div>
</div>
