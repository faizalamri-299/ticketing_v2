<?php

namespace frontend\modules\pentadbiran\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class KalendarController extends Controller
{
	 public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionBulanan()
    {
        return $this->render('bulanan');
    }

    private function loadEventsCalendarBulanan($dbEvents) {
        foreach( $dbEvents AS $event ){

            if ($event->pc_mod_status == 'K')
                $color = '#64c5b1';
            elseif ($event->pc_mod_status == 'TS')
                $color = '#ffa91c';
            elseif ($event->pc_mod_status == 'TL')
                $color = '#3333cc';
            elseif ($event->pc_mod_status == 'L')
                $color = '#32c861';
            elseif ($event->pc_mod_status == 'T')
                $color = '#f96a74';
            else
                $color = '#32c861';
            //Testing
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $event->id;
            $Event->title = $event->pc_fk_id_kakitangan .' (' . $event->pc_fk_id_kod_cuti . ')';
            $Event->start = date('Y-m-d',strtotime($event->pc_mod_tarikh_mula));
            $Event->end = ($event->pc_mod_tarikh_mula == $event->pc_mod_tarikh_tamat) ? date('Y-m-d',strtotime($event->pc_mod_tarikh_tamat)) : date('Y-m-d',strtotime($event->pc_mod_tarikh_tamat. ' +1 day'));
            $Event->backgroundColor = $color;
            $events[] = $Event;
        }
        return $events;
    }
}
