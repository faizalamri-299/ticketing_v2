<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\KodJenisDokumen */

$this->title = 'Maklumat Peribadi';
$this->params['breadcrumbs'][] = ['label' => 'Tab Peribadi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kod-jenis-dokumen-create">
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
            $activeTab1=true;; $activeTab2=false; $activeTab3=false; $activeTab4=false; 
        }
    ?>

    <?php
        $items = [
            [
                'id' => 'tab1',
                'label' => 'Maklumat Peribadi',
                'content' => $this->render("_peribadi", [
                    'model'=>$model,
                    'idKa' => $idKa,
                ]),
                'linkOptions' => ['class'=>'disabled'],
                'active' => $activeTab1,
            ],
            [
                'id' => 'tab2',
                'label' => 'Pasangan',
                'content' => $this->render("_pasangan", [
                    'model'=>$model,
                    'modelPsg'=>$modelPsg,
                    'idKa' => $idKa
                ]),
                'linkOptions' => ['class'=>'disabled'],
                'headerOptions' => ['style' => 'cursor:not-allowed;'],
                'active' => $activeTab2,
            ],
            [
                'id' => 'tab3',
                'label' => 'Anak',
                'content' => $this->render("_anak", [
                    'model'=>$model,
                    'modelAnk'=>$modelAnk,
                    'idKa' =>$idKa,
                    'dataProviderAnk' => $dataProviderAnk
                ]),
                'linkOptions' => ['class'=>'disabled'],
                'headerOptions' => ['style' => 'cursor:not-allowed;'],
                'active' => $activeTab3,
            ],
            [
                'id' => 'tab4',
                'label' => 'Perkhidmatan',
                'content' => $this->render("_perkhidmatan", [
                    'model'=>$model,
                    'modelPerkhidmatan'=>$modelPerkhidmatan,
                    'idKa' => $idKa,
                    'dataProviderPerkhidmatan' => $dataProviderPerkhidmatan
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