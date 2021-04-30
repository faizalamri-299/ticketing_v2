<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\Tuntutan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tuntutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tuntutan-view">

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
            //'id',
            'makt_fk_maklumat_anggota_id',
            'makt_fk_kod_tuntutan_id',
            // 'makt_sys_user_masuk',
            // 'makt_sys_tarikh_masuk',
            // 'makt_sys_user_kemaskini',
            // 'makt_sys_tarikh_kemaskini',
            'makt_mod_tarikh_tuntutan',
            'makt_mod_tempat_dituju',
            'makt_mod_butiran_perjalanan',
            'makt_mod_waktu_tiba_pejabat',
            'makt_mod_waktu_bertolak',
            'makt_mod_waktu_balik',
            'makt_mod_jumlah_jam',
            'makt_mod_hitungan_km',
            'makt_mod_resit',
            'makt_mod_status',
        ],
    ]) ?>

</div>
