<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodJenisDokumen */

$this->title = $model->ma_mod_nama_penuh;
$this->params['breadcrumbs'][] = ['label' => 'Tab Peribadi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kod-jenis-dokumen-create">
    <div class="row">
        <div class=col-md-9>
            <div class="card-box">
            <?php
                if(isset($_GET['tab'])){
                    $tab = $_GET['tab'];
                    if($tab == 1){
                           $activeTab1=true; $activeTab2=false; $activeTab3=false; $activeTab4=false;
                    }else if($tab == 2){
                           $activeTab1=false; $activeTab2=true; $activeTab3=false; $activeTab4=false; 
                    }else if($tab == 3){
                           $activeTab1=false; $activeTab2=false; $activeTab3=true; $activeTab4=false; 
                    }else if($tab == 4){
                           $activeTab1=false; $activeTab2=false; $activeTab3=false; $activeTab4=true; 
                    }
                }else{
                    $activeTab1=true; $activeTab2=false; $activeTab3=false; $activeTab4=false; 
                }
            ?>
            
            <?php
                $items = [
                    [
                        'id' => 'tab1',
                        'label' => 'Maklumat Peribadi',
                        'content' => $this->render("_maklumatPeribadi", [
                            'model'=>$model,
                        ]),
                        'active' => $activeTab1,
                    ],
                    [
                        'id' => 'tab2',
                        'label' => 'Pasangan',
                        'content' => $this->render("_maklumatPasangan", [
                            'model'=>$model,
                            'modelPsg'=>$modelPsg,
                        ]),
                        'active' => $activeTab2,
                    ],
                    [
                        'id' => 'tab3',
                        'label' => 'Anak',
                        'content' => $this->render("_maklumatAnak", [
                            'dataProviderAnk'=>$dataProviderAnk,
                        ]),
                        'active' => $activeTab3,
                    ],
                    [
                        'id' => 'tab4',
                        'label' => 'Perkhidmatan',
                        'content' => $this->render("_maklumatPerkhidmatan", [
                            'dataProviderPerkhidmatan'=>$dataProviderPerkhidmatan,
                        ]),
                        'active' => $activeTab4,
                    ],
                ];

                echo TabsX::widget([
                'items'=>$items,
                'position'=>TabsX::POS_ABOVE,
                'encodeLabels'=>false,
                'options' => [
                    'class' => 'tabs-bordered',
                ],
            ]); ?>
             </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="card">
                <div class="card-body ribbon-box">
                    <h4 class="header-title">Gambar</h4>
                    <a href="<?= $model->getPathPhotoLarge(); ?>" data-lightbox="gallery-set" data-title="Click the right half of the image to move forward.">
                    <img src="<?= $model->getPathPhotoMedium(); ?>" alt="" class="card-img-top img-fluid"/> 
                </div>  
            </div>
        </div>          
    </div>
</div><!-- end col -->