<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii2fullcalendar\models\Event;
use frontend\assets\CalendarAsset;
use kartik\datecontrol\DateControl;
use yii\web\View;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
use frontend\modules\pentadbiran\models\PermohonanCuti;

$kakitanganName = frontend\modules\pentadbiran\models\PermohonanCuti::getKakitanganName(); 

CalendarAsset::register($this);
$this->title = 'Kalendar Tahunan';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->registerJsFile("https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ,['position' => \yii\web\View::POS_HEAD]);?>
<?=$this->registerJsFile("@web/js/calendar_cuti_tahunan.js",['position'=>\yii\web\View::POS_END])?>

<div class="card-box">
     <h6>Petunjuk</h6>
    <div class="row">
      <div class=col-md-12>
        <div class=col-md-12>
        <span style="background-color: #ffa91c; width:100px; height:100px; padding-right: 15px; border: 1px solid;"></span> &nbsp;<b> Menunggu Kelulusan</b>&nbsp;
        <span style="background-color: #32c861; width:100px; height:100px; padding-right: 15px; border: 1px solid;"></span> &nbsp;<b>Disokong/Disahkan/Diluluskan</b>&nbsp;
        <span style="background-color: #f96a74; width:100px; height:100px; padding-right: 15px; border: 1px solid;"></span> &nbsp;<b>Tidak Disokong/Tidak Disahkan/Tidak Diluluskan/Pembatalan Cuti</b>&nbsp;
      </div>
    </div>
          <div class="row">
                    <div data-provide="calendar" id="calendar" style="height: 100%;"></div>
          </div>
</div>