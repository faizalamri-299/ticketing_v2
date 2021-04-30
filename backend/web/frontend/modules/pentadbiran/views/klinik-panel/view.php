<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KpKlinikPanel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kp Klinik Panels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kp-klinik-panel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kp_mod_nama',
            'kp_mod_no_syarikat',
            'kp_mod_no_telefon',
            'kp_mod_emel',
            'kp_mod_alamat1',
            'kp_mod_alamat2',
            'kp_mod_poskod',
        ],
    ]) ?>

</div>
