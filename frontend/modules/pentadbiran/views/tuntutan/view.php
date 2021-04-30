<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\bootstrap4\Modal;

$this->title = $model->makt_mod_butiran_tuntutan;
$this->params['breadcrumbs'][] = ['label' => 'Tuntutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php echo $this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyC3tmAHBErKYHRSYBqwpfvYPhNAhMpGCUk&libraries=visualization" ,['position' => \yii\web\View::POS_HEAD]); ?>
<?php echo $this->registerJsFile("https://code.jquery.com/jquery-latest.min.js" ,['position' => \yii\web\View::POS_HEAD]);?>
<?php echo $this->registerJsFile("@web/js/gmap_routes_tuntutan_view2.js",['position' => \yii\web\View::POS_END]); ?>
<div class="tuntutan-view">
<div class="view-btn">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            <div class="card-box">
                <h4 class="header-title mb-2 float-left">Maklumat Tuntutan</h4>
                <h5 class="float-right card-title m-0"><?= $model->getInfoStatus(); ?></h5>
                 <!-- DISPLAY UNTUK ELAUN HARIAN -->
                <?php if($model->makt_fk_kategori_tuntutan == 1){?>
                <?=  DetailView::widget([
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
                        [
                                'label' => 'Kategori Tuntutan',
                                'value' => $model->kodTuntutan->mod_kategori,
                        ],
                        [
                                'label' => 'Jenis Tuntutan',
                                'value' => $model->kodTuntutan->mod_jenis_tuntutan,
                        ],
                        'makt_sys_tarikh_masuk',
                        'makt_mod_butiran_tuntutan',
                        'makt_mod_waktu_keluar_pejabat',
                        'makt_mod_waktu_tiba_pejabat',
                        [
                                'label' => 'Jumlah Jam',
                                'value' => $model->makt_mod_jam.' Jam' 
                        ],

                    ],
                ])?>
                <?php } 
                ?>

                <!-- DISPLAY UNTUK ELAUN PERJALANAN -->
                <?php if($model->makt_fk_kategori_tuntutan == 2){?>
                <?=  DetailView::widget([
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
                        [
                                'label' => 'Kategori Tuntutan',
                                'value' => $model->kodTuntutan->mod_kategori,
                        ],
                        [
                                'label' => 'Jenis Tuntutan',
                                'value' => $model->kodTuntutan->mod_jenis_tuntutan,
                        ],
                        'makt_sys_tarikh_masuk',
                        'makt_mod_butiran_tuntutan',
                        'makt_mod_tempat_dari',
                        'makt_mod_tempat_dituju',
                        'makt_mod_waktu_bertolak',
                        'makt_mod_waktu_balik',
                        [
                                'label' => 'Jumlah KM',
                                'value' => $model->makt_mod_hitungan_km.'KM' 
                        ],
                        [
                                'label' => 'Jumlah Tuntutan',
                                'value' => 'RM'.$model->makt_mod_kiraan_tuntutan_perjalanan 
                        ],
                    ],
                ])?>
                <hr>
                    <div class="card-box">
                        <div id="dari" class="d-none"><?= $model->makt_mod_tempat_dari ?></div>
                        <div id="dituju" class="d-none"><?= $model->makt_mod_tempat_dituju ?></div>
                        <h4 class="header-title mt-2 mb-2">Paparan Peta</h4>
                        <div id="map" class="map" style="height:440px"></div>
                    </div>
                <?php } 
                ?>
                <!-- DISPLAY UNTUK ELAUN PENGANGKUTAN UDARA -->
                <?php if($model->makt_fk_kategori_tuntutan == 3){?>
                <?=  DetailView::widget([
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
                        [
                                'label' => 'Kategori Tuntutan',
                                'value' => $model->kodTuntutan->mod_kategori,
                        ],
                        [
                                'label' => 'Jenis Tuntutan',
                                'value' => $model->kodTuntutan->mod_jenis_tuntutan,
                        ],
                        'makt_sys_tarikh_masuk',
                        'makt_mod_butiran_tuntutan',
                        'makt_mod_tempat_dituju',
                        'makt_mod_waktu_bertolak',
                        'makt_mod_waktu_balik',
                    ],
                ])?>

                <?php } 
                ?>

                <!-- DISPLAY UNTUK ELAUN PENGINAPAN -->
                <?php if($model->makt_fk_kategori_tuntutan == 4 or $model->makt_fk_kategori_tuntutan == 6){?>
                <?=  DetailView::widget([
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
                        [
                                'label' => 'Kategori Tuntutan',
                                'value' => $model->kodTuntutan->mod_kategori,
                        ],
                        [
                                'label' => 'Jenis Tuntutan',
                                'value' => $model->kodTuntutan->mod_jenis_tuntutan,
                        ],
                        'makt_sys_tarikh_masuk',
                        'makt_mod_butiran_tuntutan',
                        'makt_mod_resit',
                    ],
                ])?>

                <?php } 
                ?>

                <!-- DISPLAY UNTUK ELAUN MESYUARAT -->
                <?php if($model->makt_fk_kategori_tuntutan == 5){?>
                <?=  DetailView::widget([
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
                        [
                                'label' => 'Kategori Tuntutan',
                                'value' => $model->kodTuntutan->mod_kategori,
                        ],
                        [
                                'label' => 'Jenis Tuntutan',
                                'value' => $model->kodTuntutan->mod_jenis_tuntutan,
                        ],
                        'makt_sys_tarikh_masuk',
                        'makt_mod_butiran_tuntutan',
                    ],
                ])?>

                <?php } 
                ?>

                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <?= Html::a('Kemaskini', ['/pentadbiran/tuntutan/create', 'id' => $model->id], ['class'=>'btn btn-secondary waves-effect width-md waves-light']) ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php if($model->makt_mod_resit != NULL) { ?>
                            <?= Html::a('Resit', ['papar-dokumen', 'jenis' => 'rst', 'id' => $model->id], [
                            'class' => 'btn btn-pink waves-effect width-md waves-light',
                            'title' => Yii::t('app', 'Papar Resit'),
                            'data-pjax' => 0,
                            'data-tooltip' => "tooltip",
                            'data-toggle' => 'modal',
                            'data-target' => '#dataModal',
                            'data-title' => Yii::t('app', 'Resit Tuntutan'),
                            'data-size' => Modal::SIZE_EXTRA_LARGE,
                            ]) ?>
                        <?php } ?>
                        <?php if($model->makt_mod_status == 0) { ?>
                            <?= Html::a('Semakan', ['/pentadbiran/tuntutan/semakan', 'id' => $model->id], ['class'=>'btn btn-info waves-effect width-md waves-light']) ?>
                        <?php }elseif($model->makt_mod_status == 1) { ?>
                        <?= Html::a('Tolak', ['/pentadbiran/tuntutan/tolak', 'id' => $model->id], ['class'=>'btn btn-danger waves-effect width-md waves-light', 'data-confirm' => 'Tolak permohonan tuntutan ini?']) ?>
                            <?= Html::a('Lulus', ['/pentadbiran/tuntutan/lulus', 'id' => $model->id], ['class'=>'btn btn-success waves-effect width-md waves-light']) ?>
                        <?php } ?>
                    </div>
                    
                </div>
                <br>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title"><?= $model->namaKakitangan->ma_mod_nama_penuh; ?></h5>
                            <a href="<?= $model->namaKakitangan->getPathPhotoLarge(); ?>" data-lightbox="gallery-set" data-title="Click the right half of the image to move forward.">
                            <img src="<?= $model->namaKakitangan->getPathPhotoMedium(); ?>" alt="" class="card-img-top img-fluid"/>
                            <br><hr>
                            <br>
                            <h6 class="card-subtitle text-muted"><?= $model->namaKakitangan->ma_mod_nama_penuh;?> | <?= $model->namaKakitangan->ma_mod_no_kp; ?></h6><br>
                            <h6 class="card-subtitle text-muted"><?= $model->namaKakitangan->ma_mod_no_hp; ?></h6>                            
                            </a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
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