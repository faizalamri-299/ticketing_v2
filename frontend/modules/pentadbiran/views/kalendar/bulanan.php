<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Kalendar Bulanan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card-box">
 <?= yii2fullcalendar\yii2fullcalendar::widget(array(
      'events' =>$events
    ));
?>

</div>