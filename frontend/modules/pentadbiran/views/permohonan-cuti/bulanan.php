<?php

use yii\helpers\Html;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\bootstrap4\Modal;
use yii\helpers\Json;
use yii2fullcalendar\models\Event;
use kartik\form\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\web\View;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
use frontend\modules\pentadbiran\models\PermohonanCuti;

$kakitanganName = frontend\modules\pentadbiran\models\PermohonanCuti::getKakitanganName(); 

$this->title = 'Kalendar Bulanan';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->registerJsFile("https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ,['position' => \yii\web\View::POS_HEAD]);?>

<div class="kehadiran-view">
  <div class="row">
    <div class="col-md-12">
      <div class="card-box">
        <?php

          //JS section
          $url = JSON::encode(Yii::$app->getUrlManager()->createUrl('/pentadbiran/permohonan-cuti/modal-kalendar'));
$JSEventClick = <<<EOF
function(calEvent, jsEvent, view) {

    var eventUrl = $url;
    var data = calEvent.id;
   //alert(data);
    $.get(eventUrl, {'id': data}, function(data){
        $('.modal').modal('show')
        .find('#modelContent')
        .html(data);
        //document.getElementById('modalHeader').innerHTML = '<h4>Maklumat Cuti</h4>';
    });
}
EOF;

Modal::begin([
  'id' => 'modal',
  'title' => '<h4 class="left">Maklumat Cuti</h4>',
  'headerOptions' => ['id' => 'modalHeader'],
  'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
  'size' => Modal::SIZE_LARGE,
]);
  echo "<div id='modelContent'></div>";
Modal::end();

?>



<div class="card-box">
  <div class = "row">
  <div class="col-md-6">
  <?= Select2::widget([
    'name' => 'cuti_bulanan',
    'data' => $kakitanganName,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['id' => 'cuti_bulanan', 'placeholder' => 'Sila Pilih Kakitangan','multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ], 
]);
  ?>
  </div>
  <div class ="col-md-4">
    <?= Html::a('Reset Kalendar', null, 
            [
                'class'=>'btn btn-outline-danger btn-rounded btn-bordered waves-effect width-md waves-light',
                'id' => 'resetButton'
            ]) 
        ?>

  </div>
</div>
    <h6>Petunjuk</h6>
    <div class="row">
      <div class=col-md-12>
        <span style="background-color: #ffa91c; width:100px; height:100px; padding-right: 15px; border: 1px solid;"></span> &nbsp;<b> Menunggu Kelulusan</b>&nbsp;
        <span style="background-color: #32c861; width:100px; height:100px; padding-right: 15px; border: 1px solid;"></span> &nbsp;<b>Disokong/Disahkan/Diluluskan</b>&nbsp;
        <span style="background-color: #f96a74; width:100px; height:100px; padding-right: 15px; border: 1px solid;"></span> &nbsp;<b>Tidak Disokong/Tidak Disahkan/Tidak Diluluskan/Pembatalan Cuti</b>&nbsp;
      </div>
    </div>
    <div class="row">
                  <?= yii2fullcalendar\yii2fullcalendar::widget([
                    'id'=>'eventFilterCalendar',
                    'themeSystem' => 'bootstrap4',
                    'clientOptions' => [
                          'eventSources' => [Yii::$app->getUrlManager()->createUrl(['pentadbiran/permohonan-cuti/filter-events-calendar-bulanan'])],
                          'defaultDate' => date('Y-m-d'),
                          'eventClick' => new JsExpression($JSEventClick),
                          'header' => [
                                  'center'=>'title',
                                  'left'=>'prev,next',
                                  'right'=>'month',
                              ],
                      ],
            ]);

?>
</div>
</div>

<?php

$js = "

        var eventSource=[".JSON::encode(Yii::$app->getUrlManager()->createUrl(['pentadbiran/permohonan-cuti/filter-events-calendar-bulanan']))."];

        $('#cuti_bulanan').on('change',function() {
          // alert($(this).val());
        //get current status of our filters into eventSourceNew
        var eventSourceNew=[".JSON::encode(Yii::$app->getUrlManager()->createUrl(['pentadbiran/permohonan-cuti/filter-events-calendar-bulanan']))."+'?cuti='+$(this).val()];

        //remove the old eventSources
        $('#eventFilterCalendar').fullCalendar('removeEventSource', eventSource[0]);
        //attach the new eventSources
        $('#eventFilterCalendar').fullCalendar('addEventSource', eventSourceNew[0]);
        $('#eventFilterCalendar').fullCalendar('refetchEvents');

        //copy to current source 
        eventSource = eventSourceNew;
    });

    // reset sources of the calendar
    $('#resetButton').on('click',function() {
        $('#cuti_bulanan').val('').trigger('change');
        //get current status of our filters into eventSourceNew
        var eventSourceNew=[".JSON::encode(Yii::$app->getUrlManager()->createUrl(['pentadbiran/permohonan-cuti/filter-events-calendar-bulanan']))."];

        //remove the old eventSources
        $('#eventFilterCalendar').fullCalendar('removeEventSource', eventSource[0]);
        //attach the new eventSources
        $('#eventFilterCalendar').fullCalendar('addEventSource', eventSourceNew[0]);
        $('#eventFilterCalendar').fullCalendar('refetchEvents');

        //copy to current source 
        eventSource = eventSourceNew;
    });
    ";

    $this->registerJs($js, \yii\web\View::POS_READY);
?>