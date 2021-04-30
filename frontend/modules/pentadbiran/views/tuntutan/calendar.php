<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\CalendarAsset;
CalendarAsset::register($this);

$this->title = 'Kalendar Bulanan';
$this->params['breadcrumbs'][] = $this->title;
?>

  <div class="row">
            <div data-provide="calendar" id="calendar" style="height: 100%;"></div>
  </div>


<?php
$js = "
new Calendar('.calendar');";

$this->registerJs($js);

?>