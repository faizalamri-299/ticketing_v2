<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use common\components\BitGridView;



\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-12">
        <?= BitGridView::widget([
            'dataProvider' => $dataProviderPerkhidmatan,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
            'summary' => false,
            'responsiveWrap' => false,
            'emptyText' => 'Tiada maklumat Perkhidmatan.',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn',
                    'options' => ['style' => 'width:10px;']],
                
                'kajt_flag_eksekutif',
                'kajt_mod_no_kakitangan',
                'infoTarikhLantikan',
                'infoTarikhTamat',
                'infoStatus:html',
                ],
        ]); 
        ?>
    </div>
</div>
