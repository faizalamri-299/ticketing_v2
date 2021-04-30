<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\bootstrap4\Modal;
use kartik\form\ActiveForm;

use frontend\modules\pentadbiran\models\PermohonanCuti;
/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\PermohonanCuti */

$this->title = 'Maklumat Permohonan Cuti ';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>

    <div class="row">
       <div class="col-md-3">
            <div class="card-box h-100">
                <div class="col-md-12">
                    <a href="<?= $model->kakitangan->getPathPhotoMedium(); ?>" data-lightbox="gallery-set" data-title="Click the right half of the image to move forward.">
                    <img src="<?= $model->kakitangan->getPathPhotoMedium(); ?>" alt="" class="card-img-top img-fluid"/>
                    <br>
                    </a> 
                </div>
            </div>
        </div>
        <div class="col-md-9">
            
                <div class="card-box h-100">
                     <?= DetailView::widget([
                            'model' => $model,
                            'striped' => false,
                            'bordered' => false,
                            'condensed' => 'false',
                            'labelColOptions' => [
                                'style' => 'border:0; text-align:left;'
                            ],
                            'hAlign' => 'left',
                            'vAlign' => 'top',
                            'valueColOptions' => [
                                'style' => 'border: 0;  text-align : left;'
                            ],
                            'attributes' => [
                                [
                                    'label' => 'No Kakitangan',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->kajt_mod_no_kakitangan,
                                ],
                                [
                                    'label' => 'Nama Kakitangan',
                                    'value' => $model->kakitangan->ma_mod_nama_penuh,
                                ],
                                [
                                    'label' => 'No Kad Pengenalan',
                                    'value' => $model->kakitangan->ma_mod_no_kp,
                                ],
                                [
                                    'label' => 'Eksekutif',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->kajt_flag_eksekutif,
                                ],
                                [
                                    'label' => 'Anggota/Kakitangan',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->kajt_mod_kategori_anggota,
                                ],
                                [
                                    'label' => 'Unit',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->jawatan->unit->ut_mod_nama_unit,
                                ],
                                [
                                    'label' => 'Jawatan',
                                    'value' => $model->kakitangan->kakitanganHasJawatan->jawatan->jt_mod_nama_jawatan,
                                ],
                                [
                                'label' => 'Baki Cuti',
                                'value' => $model->kakitanganHasKodCuti->makc_sys_baki_cuti.' / '.$model->kakitanganHasKodCuti->makc_mod_jumlah_cuti,
                                ],
                            ],
                    ]) ?>
                </div> 
                <!-- <div class="card-box h-30">
                    <?= DetailView::widget([
                        'model' => $model,
                        'striped' => false,
                        'bordered' => false,
                        'condensed' => 'false',
                        'labelColOptions' => [
                            'style' => 'border:0; text-align:left;'
                        ],
                        'hAlign' => 'left',
                        'vAlign' => 'top',
                        'valueColOptions' => [
                            'style' => 'border: 0;  text-align : left;'
                        ],
                        'attributes' => [
                            [
                                'label' => 'Baki Cuti',
                                'value' => $model->kakitanganHasKodCuti->makc_sys_baki_cuti.' / '.$model->kakitanganHasKodCuti->makc_mod_jumlah_cuti,
                            ],
                        ],
                    ]) ?>  
                </div> -->
           
        </div>
    </div>
    <hr>
    <div class ="card-box">
        <h4 class="header-title">Maklumat Cuti <?= $model->getInfoStatusCuti(); ?></h4>
        <div class="row">
            <div class="col-md-6">
                <?php if($model->pc_mod_jenis_cuti == 1){?>
                <?= DetailView::widget([
                    'model' => $model,
                    'striped' => false,
                    'bordered' => false,
                    'condensed' => 'false',
                    'labelColOptions' => [
                        'style' => 'border:0; text-align:left;'
                    ],
                    'hAlign' => 'left',
                    'vAlign' => 'top',
                    'valueColOptions' => [
                        'style' => 'border: 0;  text-align : left;'
                    ],
                    'attributes' => [
                        [
                            'label' => 'Jenis Cuti',
                            'value' => $model->kodCuti->mod_jenis,
                        ],
                        [
                            'label' => 'Kategori Cuti',
                            'value' => $model->kodKategoriCuti->kkc_mod_kategori
                        ],
                        //'pc_mod_tarikh_mula:date',
                        'pc_mod_keterangan:ntext',
                    ],
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'striped' => false,
                    'bordered' => false,
                    'condensed' => 'false',
                    'labelColOptions' => [
                        'style' => 'border:0; text-align:left;'
                    ],
                    'hAlign' => 'left',
                    'vAlign' => 'top',
                    'valueColOptions' => [
                        'style' => 'border: 0;  text-align : left;'
                    ],
                    'attributes' => [
                        // [
                        //     'label' => 'Kategori Cuti',
                        //     'value' => $model->kodKategoriCuti->kkc_mod_kategori
                        // ],
                        'pc_mod_tarikh_mula:date',
                        'pc_mod_tarikh_tamat:date',
                        [
                            'label' => 'Bilangan Cuti',
                            'value' => $model->pc_sys_bil_cuti.' Hari' 
                        ],
                        // [
                        //     'label' => 'Baki Cuti',
                        //     'value' => $model->pc_sys_baki_cuti.' Hari' 
                        // ],
                    ],
                ]) ?>
                <?php } 
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php if($model->pc_mod_jenis_cuti == 2 or $model->pc_mod_jenis_cuti == 3){?>
                <?= DetailView::widget([
                    'model' => $model,
                    'striped' => false,
                    'bordered' => false,
                    'condensed' => 'false',
                    'labelColOptions' => [
                        'style' => 'border:0; text-align:left;'
                    ],
                    'hAlign' => 'left',
                    'vAlign' => 'top',
                    'valueColOptions' => [
                        'style' => 'border: 0;  text-align : left;'
                    ],
                    'attributes' => [
                        [
                            'label' => 'Jenis Cuti',
                            'value' => $model->kodCuti->mod_jenis,
                        ],
                        [
                            'label' => 'Kategori Cuti',
                            'value' => $model->kodKategoriCuti->kkc_mod_kategori
                        ],
                        // 'pc_mod_tarikh_tamat',
                        
                         'pc_mod_keterangan:ntext',
                    ],
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'striped' => false,
                    'bordered' => false,
                    'condensed' => 'false',
                    'labelColOptions' => [
                        'style' => 'border:0; text-align:left;'
                    ],
                    'hAlign' => 'left',
                    'vAlign' => 'top',
                    'valueColOptions' => [
                        'style' => 'border: 0;  text-align : left;'
                    ],
                    'attributes' => [
                        'pc_mod_tarikh_mula:date',
                        'pc_mod_tarikh_tamat:date',
                        [
                            'label' => 'Bilangan Cuti',
                            'value' => $model->pc_sys_bil_cuti.' Hari' 
                        ],
                    ],
                ]) ?>
                <?php } 
                ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <?php if ($model->pc_mod_status == 0)
                {
                   echo Html::a('Pembatalan Cuti', ['pembatalan-cuti', 'id' => $model->id], ['class' => 'btn btn-danger']);         
                }
                ?> 
            </div>
            <div class="col-md-6 text-right">
                <?php
                    if(!empty($model->pc_mod_surat_sokongan)){
                        echo Html::a('Dokumen Sokongan', ['paparan-surat','jenis' => 'surat', 'id' => $model->id], [
                            'class' => 'btn btn-pink waves-effect width-md waves-light',
                            'title' => Yii::t('app', 'Dokumen Sokongan'),
                            'data-pjax' => 0,
                            'data-tooltip' => "tooltip",
                            'data-toggle' => 'modal',
                            'data-target' => '#suratSokongan',
                            'data-title' => Yii::t('app', 'Paparan Dokumen Sokongan'),
                            'data-size' => Modal::SIZE_EXTRA_LARGE,
                            ]);
                 }?>
            
                <?php if ($model->pc_mod_status == 0)
                    {
                        echo Html::a('Tolak', ['tidak-sokong', 'id' => $model->id], ['class' => 'btn btn-danger mr-1']);    
                        echo Html::a('Sokong', ['sokong', 'id' => $model->id], ['class' => 'btn btn-success']);     
                    } 
                    elseif ($model->pc_mod_status == 1)
                    {
                        echo Html::a('Tolak', ['tidak-sah', 'id' => $model->id], ['class' => 'btn btn-danger mr-1']); 
                        echo Html::a('Sah', ['sah', 'id' => $model->id], ['class' => 'btn btn-success']);
                    } 

                    elseif ($model->pc_mod_status == 3)
                    {
                        echo Html::a('Tolak', ['tidak-lulus', 'id' => $model->id], ['class' => 'btn btn-danger mr-1']);
                        echo Html::a('Lulus', ['lulus', 'id' => $model->id], ['class' => 'btn btn-success']);
                    } 
                ?>
           </div>
        </div>
    </div>   


<?php Modal::begin([
    'id' => 'suratSokongan',
    'title' => '',
    ]) ?>

<?php Modal::end() ?>


<?php
$js = "
    $('#suratSokongan').on('show.bs.modal', function (event) {
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

    $('#suratSokongan').on('hidden.bs.modal', function (event) {
        $(this).find('.modal-body').html('');
        $(this).find('.modal-title').html('');
    });
";
$this->registerJs($js);
?> 


