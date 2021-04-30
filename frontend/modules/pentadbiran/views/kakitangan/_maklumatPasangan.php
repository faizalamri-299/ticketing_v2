<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\pentadbiran\models\DdDokumenDigital */

?>

<?php if (isset($modelPsg->id)){?>

<div class="maklumat-pasangan">
    <div class="row">
        <div class="col-md-6">
              <?php if(isset($modelPsg->id)){?>
         <?= DetailView::widget([
                   'model' => $modelPsg,
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
                    'mp_mod_nama',
                    'infoTarikhLahir',
                    'mp_mod_no_kp',
                    'mp_mod_warganegara',
                    'infoPekerjaan',
                    'infoNamaMajikan',
                    'infoAlamat',
                    'mp_mod_no_hp',
                    'infoNoPejabat',
                ],
            ]) ?>
          <?php }else{?>
        <h4 class="header-title">tiada pasangan</h4>
    <?php }?>   
        </div>

    </div>
</div>

<?php 
    } 
    else
    {
        echo '<span>Tiada Maklumat Pasangan.</span><br/>';
    }
?>
