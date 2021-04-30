<?php

namespace frontend\modules\pentadbiran\controllers;

use Yii;
use frontend\modules\pentadbiran\models\KodCuti;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\PermohonanCuti;
use frontend\modules\pentadbiran\models\PermohonanCutiSearch;
use frontend\modules\pentadbiran\models\KakitanganHasKodCuti;
use frontend\modules\pentadbiran\models\KakitanganHasKodCutiSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Time;
use yii\helpers\Json;
use yii\web\Response;
use yii\data\Sort;
use common\models\UploadImage;

/**
 * PermohonanCutiController implements the CRUD actions for PermohonanCuti model.
 */
class PermohonanCutiController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all PermohonanCuti models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermohonanCutiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }

    /**
     * Displays a single PermohonanCuti model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PermohonanCuti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idKa = NULL)
    {
        $model = new PermohonanCuti();

        if ($model->load(Yii::$app->request->post())) {

            $model->pc_mod_status = '0';
            if($model->save())
            {
                $modelCuti = KakitanganHasKodCuti::find()
                    ->where(['makc_fk_maklumat_anggota_id' => $model->pc_fk_maklumat_anggota_id])
                    ->andWhere(['makc_fk_kod_cuti_id'=>$model->pc_fk_kod_cuti_id])->one();
                
                //upload surat sokongan
                $tempSurat = UploadedFile::getInstance($model, 'tempSurat');    
                if(!empty($tempSurat)) {
                        $modelFile = new UploadImage();
                        $modelFile->fail = $tempSurat;
                        $modelFile->uploadFail($model->id, 'SuratSokongan');
                    }
                 //Get id from table kakitangan_cuti and insert into pc_fk_id_kakitangan_cuti at table permohonan_cuti
                $model->pc_fk_maklumat_anggota_cuti_id = $modelCuti['id'];
    //******************************calculate balance cuti***********************
                if ($model->pc_mod_jenis_cuti == '1'){

                    $tarikh = $model->tarikh;
                    $tarikh_form=explode(' - ', $tarikh);

                    $tarikhmula=Yii::$app->formatter->asDate($tarikh_form[0], 'php:Y-m-d');
                    $tarikhtamat=Yii::$app->formatter->asDate($tarikh_form[1], 'php:Y-m-d');

                    $model->pc_mod_tarikh_mula=$tarikhmula;
                    $model->pc_mod_tarikh_tamat=$tarikhtamat;
                   
                    $date1 = new \DateTime($model->pc_mod_tarikh_mula);
                    $date2 = new \DateTime($model->pc_mod_tarikh_tamat);

                    $myDay = date_diff($date1, $date2);
                    $myDays = $myDay->days+1;
                    $model->pc_sys_bil_cuti = $myDays;
                }

                else {
                    $model->pc_mod_tarikh_mula = Yii::$app->formatter->asDate($model->pc_mod_tarikh_mula, 'php:Y-m-d');

                    $model->pc_mod_tarikh_tamat = $model->pc_mod_tarikh_mula;
                    $model->pc_sys_bil_cuti = 0.5;
                }
                $baki_cuti = $modelCuti->makc_sys_baki_cuti -  $model->pc_sys_bil_cuti;
                $model->pc_sys_baki_cuti = $baki_cuti;
                $modelCuti->makc_sys_baki_cuti = $baki_cuti;

                $modelCuti->save();
                $model->save();

                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'Permohonan Dihantar',
                        'text' => 'Permohonan Cuti Telah Dihantar!',
                        'confirmButtonText' => 'Done!',
                    ]]);
                

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PermohonanCuti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionUpdate($id)
    {
        $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post())) {

            if($model->save())
            {
                $modelCuti = KakitanganHasKodCuti::find()
                    ->where(['makc_fk_maklumat_anggota_id' => $model->pc_fk_maklumat_anggota_id])
                    ->andWhere(['makc_fk_kod_cuti_id'=>$model->pc_fk_kod_cuti_id])->one();
                
                //upload surat sokongan
                $tempSurat = UploadedFile::getInstance($model, 'tempSurat');    
                if(!empty($tempSurat)) {
                        $modelFile = new UploadImage();
                        $modelFile->fail = $tempSurat;
                        $modelFile->uploadFail($model->id, 'SuratSokongan');
                    }
                 //Get id from table kakitangan_cuti and insert into pc_fk_id_kakitangan_cuti at table permohonan_cuti
                $model->pc_fk_maklumat_anggota_cuti_id = $modelCuti['id'];
    //******************************calculate balance cuti***********************
                if ($model->pc_mod_jenis_cuti == '1'){

                    $tarikh = $model->tarikh;
                    $tarikh_form=explode(' - ', $tarikh);

                    $tarikhmula_lama = $model->pc_mod_tarikh_mula;
                    $tarikhtamat_lama = $model->pc_mod_tarikh_tamat;
                    
                    $beza_hari = date_diff($tarikhmula_lama, $tarikhtamat_lama);
                    $beza_hari = $beza_hari->days+1;
                    
                    $tarikhmula=Yii::$app->formatter->asDate($tarikh_form[0], 'php:Y-m-d');
                    $tarikhtamat=Yii::$app->formatter->asDate($tarikh_form[1], 'php:Y-m-d');

                    $model->pc_mod_tarikh_mula=$tarikhmula;
                    $model->pc_mod_tarikh_tamat=$tarikhtamat;
                   
                    $date1 = new \DateTime($model->pc_mod_tarikh_mula);
                    $date2 = new \DateTime($model->pc_mod_tarikh_tamat);

                    $myDay = date_diff($date1, $date2);
                    $myDays = $myDay->days+1;
                    $model->pc_sys_bil_cuti = $myDays;
                    $baki_cuti = $modelCuti->makc_sys_baki_cuti + ($beza_hari - $myDays);
                }

                else {
                    $model->pc_mod_tarikh_mula = Yii::$app->formatter->asDate($model->pc_mod_tarikh_mula, 'php:Y-m-d');

                    $model->pc_mod_tarikh_tamat = $model->pc_mod_tarikh_mula;
                    $model->pc_sys_bil_cuti = 0.5;
                    $baki_cuti = $modelCuti->makc_sys_baki_cuti - $model->pc_sys_bil_cuti;
                }
                
                $model->pc_sys_baki_cuti = $baki_cuti;
                $modelCuti->makc_sys_baki_cuti = $baki_cuti;

                $modelCuti->save();
                $model->save();

                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'Kemaskini Berjaya',
                        'text' => 'Permohonan Cuti dikemaskini',
                        'confirmButtonText' => 'Done!',
                    ]]);
                

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PermohonanCuti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    //********************************Action Ketua Unit [START]***********************************
     public function actionSokong($id)
    { 
        //if status is 1=dalam proses(sokong)
       
        $model = $this->findModel($id);


                Yii::$app->db->createCommand()
                     ->update('tbl_pc_permohonan_cuti', ['pc_mod_status' => 1],'id=:id', array(':id'=>$id))
                     ->execute();
                 

                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'Disokong',
                        'text' => 'Permohonan Telah Disokong oleh HOD!',
                        'confirmButtonText' => 'Done!',
                    ]]);
        

            return $this->redirect(['view', 'id' => $model->id]);
    }

     public function actionTidakSokong($id)
    {
        //if status is 2=dalam proses (tidak sokong)
         $model = $this->findModel($id);
        
        Yii::$app->db->createCommand()
             ->update('tbl_pc_permohonan_cuti', ['pc_mod_status' => 2],'id=:id', array(':id'=>$id))
             ->execute();
             //->getRawSql(); exit();

            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_ERROR, [
                [
                    'title' => 'Tolak',
                    'text' => 'Permohonan Cuti Tidak Disokong oleh HOD!',
                    'confirmButtonText' => 'Done!',
                ]]);
            return $this->redirect(['view', 'id' => $model->id]);
    }

    //********************************Action Ketua Unit [End]***********************************

    //********************************Action UPSM [START]***********************************

    public function actionSah($id)
    {
        //if status is 3=disokong (sah)
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()
             ->update('tbl_pc_permohonan_cuti', ['pc_mod_status' => 3],'id=:id', array(':id'=>$id))
             ->execute();
             //->getRawSql(); exit();

            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Sah',
                    'text' => 'Permohonan Cuti Disahkan oleh UPSM!',
                    'confirmButtonText' => 'Done!',
                ]]);
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionTidakSah($id)
    {
        //if status is 3=sah (tidak sah)
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()
             ->update('tbl_pc_permohonan_cuti', ['pc_mod_status' => 4],'id=:id', array(':id'=>$id))
             ->execute();
             //->getRawSql(); exit();

            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_ERROR, [
                [
                    'title' => 'Tidak Sah',
                    'text' => 'Permohonan Cuti Tidak Disahkan oleh UPSM!',
                    'confirmButtonText' => 'Done!',
                ]]);
        return $this->redirect(['view', 'id' => $model->id]);

    }
    
    //********************************Action UPSM [END]***********************************
    //********************************Action CEO [START]***********************************
    public function actionLulus($id)
    {
        //if status is 5=sah (lulus)
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()
             ->update('tbl_pc_permohonan_cuti', ['pc_mod_status' => 5],'id=:id', array(':id'=>$id))
             ->execute();
             //->getRawSql(); exit();

            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Lulus',
                    'text' => 'Permohonan Cuti Diluluskan oleh CEO!',
                    'confirmButtonText' => 'Done!',
                ]]);
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionTidakLulus($id)
    {
        //if status is 5=sah (tidak lulus)
        $model = $this->findModel($id);

        Yii::$app->db->createCommand()
             ->update('tbl_pc_permohonan_cuti', ['pc_mod_status' => 6],'id=:id', array(':id'=>$id))
             ->execute();
             //->getRawSql(); exit();

            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_ERROR, [
                [
                    'title' => 'Tidak Diluluskan',
                    'text' => 'Permohonan Cuti Tidak Diluluskan oleh Ceo!',
                    'confirmButtonText' => 'Done!',
                ]]);
        return $this->redirect(['view', 'id' => $model->id]);

    }

    //********************************Action CEO [END]***********************************
    //****************************Action Pembatalan Cuti*********************************
    public function actionPembatalanCuti($id)
    {
        $model = $this->findModel($id);

        $modelCuti = KakitanganHasKodCuti::findOne(['id'=> $model->pc_fk_maklumat_anggota_cuti_id,'makc_fk_maklumat_anggota_id' => $model->pc_fk_maklumat_anggota_id, 'makc_fk_kod_cuti_id'=>$model->pc_fk_kod_cuti_id]);
        
        //Get id from table kakitangan_cuti and insert into pc_fk_id_kakitangan_cuti at table permohonan_cuti

        $model->pc_fk_maklumat_anggota_cuti_id = $modelCuti['id'];

        $batal_cuti = $model->pc_sys_baki_cuti + $model->pc_sys_bil_cuti;
        $model->pc_sys_baki_cuti = $batal_cuti;
        $modelCuti->makc_sys_baki_cuti = $batal_cuti;

        $modelCuti->save();
        $model->save();


        Yii::$app->db->createCommand()
             ->update('tbl_pc_permohonan_cuti', ['pc_mod_status' => 7],'id=:id', array(':id'=>$id))
             ->execute();
             //->getRawSql(); exit();

            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Berjaya',
                    'text' => 'Pembatalan Cuti Berjaya!',
                    'confirmButtonText' => 'Done!',
                ]]);
        return $this->redirect(['view', 'id' => $model->id]);
    }
    //function dep dropdown for kakitangan & kod cuti
    public function actionCuti()
    {
        $out = [];
        
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            
            if ($parents != null) {
                $kakitanganId = $parents[0];
                $out = PermohonanCuti::getKodCutiDepDrop($kakitanganId); 
                
                 return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }  

       return json_encode(['output'=>$out, 'selected'=>'']);
    }
 
    public function actionPaparanSurat($jenis, $id)
    {
        $model = $this->findModel($id);
        //var_dump($id);exit();

        switch($jenis) {
            case 'surat':
                $url = Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/files/SuratSokongan/' . 
                $model->id .'/'. $model->pc_mod_surat_sokongan;
                break;
        }
        return '<iframe src="' . $url . '" width="100%" height="600"></iframe>';
    }
    /**
     * Finds the PermohonanCuti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermohonanCuti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermohonanCuti::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//************************************** CALENDAR EVENT **************************************\\
    //*************************************** START ****************************************\\
    public function actionKalendar()
    {
        return $this->render('kalendar', [
        ]);
    }

    public function actionGetCalendar()
    {
        $model = PermohonanCuti::find()->joinWith(['kakitangan','kodCuti'])->asArray()->all();


        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $model;
        
    }

    public function actionBulanan()
    {
        return $this->render('bulanan', [
        ]);
    }

    public function actionGetBulanan()
    {
        $model = PermohonanCuti::find()->joinWith(['kakitangan', 'kodCuti'])->asArray()->all();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;;

        return $model;;
    }


     public function actionFilterEventsCalendarBulanan($cuti = null) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $query = PermohonanCuti::find();

        if( is_null($cuti) || $cuti=='all'){
            //the function should return the same events that you were loading before
            $dbEvents = $query->all();
        } else{
            //here you need to look up into the data base 
            //for the relevant events against your jenis
            $cutiArray = explode(',', $cuti);
            $dbEvents = $query
                ->where(['IN', 'pc_fk_id_kakitangan', $cutiArray])
                ->all();
        }

        return $this->loadEventsCalendarBulanan($dbEvents);
    }

      private function loadEventsCalendarBulanan($dbEvents) {
        foreach( $dbEvents AS $event ){
            if ($event->pc_mod_status == '0')
                $color = '#ffa91c';
            elseif ($event->pc_mod_status == '1')
                $color = '#32c861';
            elseif ($event->pc_mod_status == '2')
                $color = '#f96a74';
            elseif ($event->pc_mod_status == '3')
                $color = '#32c861';
            elseif ($event->pc_mod_status == '4')
                $color = '#f96a74';
            elseif ($event->pc_mod_status == '5')
                $color = '#32c861';
            elseif ($event->pc_mod_status == '6')
                $color = '#f96a74';
            elseif ($event->pc_mod_status == '7')
                $color = '#f96a74';
            else
                $color = '#f96a74';
            //Testing
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $event->id;
            $Event->title = $event->kakitangan->ma_mod_nama_penuh .' (' . $event->kodCuti->mod_jenis . ')';
            $Event->start = date('Y-m-d',strtotime($event->pc_mod_tarikh_mula));
            $Event->end = ($event->pc_mod_tarikh_mula == $event->pc_mod_tarikh_tamat) ? date('Y-m-d',strtotime($event->pc_mod_tarikh_tamat)) : date('Y-m-d',strtotime($event->pc_mod_tarikh_tamat. ' +1 day'));
            $Event->backgroundColor = $color;
            $events[] = $Event;
        }
        return $events;
    }

    public function actionModalKalendar($id) 
    {
        $maklumat = PermohonanCuti::findOne(['id'=>$id]);
        
        return $this->renderAjax('_modalInfoCuti', [
            'maklumat' => $maklumat,
        ]);

    }
    //*************************************** END ****************************************\\
}
