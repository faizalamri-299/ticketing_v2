<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use common\components\BitGridView;

?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <h4 class="header-title mb-3">Maklumat Anak</h4>
        <?= BitGridView::widget([
            'dataProvider' => $dataProviderAnk,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
            'summary' => false,
            'responsiveWrap' => false,
            'emptyText' => 'Tiada maklumat Anak.',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn',
                    'options' => ['style' => 'width:10px;']],
                
                'man_mod_nama',
                'infoTarikhLahir',
                'man_mod_jenis_pengenalan',
                'man_mod_no_pengenalan',
                'man_mod_nama_insitusi'
                ],
        ]); 
        ?>
    </div>          
</div>