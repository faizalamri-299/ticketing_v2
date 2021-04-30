<?php

namespace frontend\modules\pentadbiran\controllers;

use Yii;
use frontend\modules\pentadbiran\models\Tuntutan;
use frontend\modules\pentadbiran\models\TuntutanSearch;
use frontend\modules\pentadbiran\models\Kakitangan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\UploadImage;
use yii\web\UploadedFile;
/**
 * TuntutanController implements the CRUD actions for Tuntutan model.
 */
class TuntutanController extends Controller
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
     * Lists all Tuntutan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TuntutanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $queryTuntutan = Tuntutan::find()->orderBy('makt_mod_status ASC');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $queryTuntutan,
            'pagination' => false
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tuntutan model.
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
     * Creates a new Tuntutan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tuntutan();

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->makt_mod_status = 0;
            if($model->save())
            {
                // Upload file
                $tempFile = UploadedFile::getInstance($model, 'tempFile');    
                if(!empty($tempFile)) {
                        $modelFile = new UploadImage();
                        $modelFile->fail = $tempFile;
                        $modelFile->uploadFail($model->id, 'TuntutanResit');
                    }
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Pendaftaran Berjaya',
                    'text' => 'Pendaftaran Tuntutan Telah Berjaya!',
                    'confirmButtonText' => 'Done!',
                ]]);

                return $this->redirect(['index', 'id' => $model->id]);
                }            
        }

        return $this->render('create', [
            'model' => $model,
            'modelFile' => $modelFile,
        ]);
    }

    /**
     * Updates an existing Tuntutan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tuntutan model.
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

    public function actionKategori()
    {
        $out = [];
        
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            
            if ($parents != null) {
                $tuntutanId = $parents[0];
                $out = Tuntutan::getTuntutanDepDrop($tuntutanId); 
                
                return Json_encode(['output'=>$out, 'selected'=>'']);

                
            }
        }
        
        return Json_encode(['output'=>$out, 'selected'=>'']);
    }


    public function actionPaparDokumen($jenis, $id)
    {
        $model = $this->findModel($id);
        //var_dump($id);exit();

        switch($jenis) {
            case 'rst':
                $url = Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/files/TuntutanResit/' . 
                $model->id .'/'. $model->makt_mod_resit;
                break;
        }
        return '<iframe src="' . $url . '" width="100%" height="600"></iframe>';
    }

    /***************************** [STATUS TUNTUTAN] ************************/
    public function actionSemakan($id)
    {
        $model = Tuntutan::findOne(['id'=>$id]);

        $model->makt_mod_status = 1;
        
        if($model->save()){

            //Yii::$app->queue->push(new EmailWorker(['jenis'=>'sukarelawan-b', 'sukarelawan'=>$model]));

            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Berjaya',
                    'text' => 'Permohonan tuntutan berjaya dihantar untuk semakan.',
                    'confirmButtonText' => 'Ok!',
                ],
            ]);
        }

        return $this->redirect(['view', 'id' => $model->id]);

    }

    public function actionLulus($id)
    {
        $model = Tuntutan::findOne(['id'=>$id]);

        $model->makt_mod_status = 2;
        
        if($model->save()){

            //Yii::$app->queue->push(new EmailWorker(['jenis'=>'sukarelawan-b', 'sukarelawan'=>$model]));

            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Berjaya',
                    'text' => 'Permohonan tuntutan telah lulus',
                    'confirmButtonText' => 'Ok!',
                ],
            ]);
        }

        return $this->redirect(['view', 'id' => $model->id]);

    }

    public function actionTolak($id)
    {
        $model = Tuntutan::findOne(['id'=>$id]);

        $model->makt_mod_status = 3;
        
        if($model->save()){

            //Yii::$app->queue->push(new EmailWorker(['jenis'=>'sukarelawan-b', 'sukarelawan'=>$model]));

            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Berjaya',
                    'text' => 'Permohonan tuntutan telah ditolak',
                    'confirmButtonText' => 'Ok!',
                ],
            ]);
        }

        return $this->redirect(['view', 'id' => $model->id]);

    }

    /***************************** [STATUS TUNTUTAN] ************************/

    /**
     * Finds the Tuntutan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tuntutan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tuntutan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
