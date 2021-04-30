<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodTuntutan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kod Tuntutans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kod-tuntutan-view">

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
            'mod_kod_tuntutan',
            'mod_jenis_tuntutan',
            'mod_keterangan',
            'mod_penuntut',
            'mod_kadar',
            'mod_nilaian',
        ],
    ]) ?>

</div>
