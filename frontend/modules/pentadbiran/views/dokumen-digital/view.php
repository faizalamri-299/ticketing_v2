<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\DdDokumenDigital */

$this->title = $model->dd_mod_tajuk_dokumen;
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Digital', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dd-dokumen-digital-view">
    <div class="card-box">

    <?= DetailView::widget([
        'model' => $model,
        'enableEditMode' => false,
        'striped' => false,
        'bordered' => false,
        'condensed' => true,
        'labelColOptions' => [
            'style' => 'border: 0;',
        ],
        'hAlign' => 'left',
        'vAlign' => 'top',
        'valueColOptions' => [
            'style' => 'border: 0;',
        ],
        'attributes' => [
            //'id',
            [
                'label' => 'Kod Jenis Dokumen',
                'value' => $model->jenisDokumen->mod_kod,
            ],
            [
                'label' => 'Jenis Dokumen',
                'value' => $model->jenisDokumen->mod_keterangan,
            ],
            'dd_mod_tajuk_dokumen',
            'dd_mod_no_rujukan',
            'dd_mod_dokumen_daripada',
            'dd_mod_dokumen_kepada',
            'dd_mod_tarikh_terima',
            'dd_mod_tarikh_serah',
            'dd_mod_dokumen',
        ],
    ]) ?>
    <hr>
        <div class="col-md-12 text-left">
            <?= Html::a('Dokumen', ['papar-dokumen', 'jenis' => 'ddigital', 'id' => $model->id], [
            'class' => 'btn btn-pink waves-effect width-md waves-light',
            'title' => Yii::t('app', 'Papar Dokumen'),
            'data-pjax' => 0,
            'data-tooltip' => "tooltip",
            'data-toggle' => 'modal',
            'data-target' => '#dataModal',
            'data-title' => Yii::t('app', 'Dokumen Digital'),
            'data-size' => Modal::SIZE_EXTRA_LARGE,
            ]) ?>
        </div>
    </div>
</div>

<?php Modal::begin([
    'id' => 'dataModal',
    'title' => '',
]) ?>
<?php Modal::end() ?>

<?php
$js = "
    $('#dataModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var title = button.data('title');
        var href = button.attr('href');
        var modalSize = button.data('size');
        modal.find('.modal-dialog').removeClass().addClass('modal-dialog ' + modalSize);
        modal.find('.modal-title').html(title);
        $.post(href).done(function( data ) {
            modal.find('.modal-body').html(data);
        });
    });

    $('#dataModal').on('hidden.bs.modal', function (event) {
        $(this).find('.modal-body').html('');
        $(this).find('.modal-title').html('');
    });
";
$this->registerJs($js);
?>