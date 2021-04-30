<?php

namespace frontend\modules\pentadbiran\controllers;

use Yii;
use frontend\modules\pentadbiran\models\DokumenDigital;
use frontend\modules\pentadbiran\models\DokumenDigitalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UploadImage;
use yii\web\UploadedFile;

/**
 * DokumenDigitalController implements the CRUD actions for DdDokumenDigital model.
 */
class DokumenDigitalController extends Controller
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
     * Lists all DdDokumenDigital models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DokumenDigitalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DdDokumenDigital model.
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
     * Creates a new DdDokumenDigital model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DokumenDigital();
        

        if ($model->load(Yii::$app->request->post())) {

            if($model->save()){
                // Upload file
                $tempFile = UploadedFile::getInstance($model, 'tempFile');    
                if(!empty($tempFile)) {
                        $modelFile = new UploadImage();
                        $modelFile->fail = $tempFile;
                        $modelFile->uploadFail($model->id, 'dokumendigital');
                    }

                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Berjaya!',
                    'text' => 'Dokumen digital telah berjaya disimpan',
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
     * Updates an existing DdDokumenDigital model.
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
     * Deletes an existing DdDokumenDigital model.
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

    public function actionPaparDokumen($jenis, $id)
    {
        $model = $this->findModel($id);
        //var_dump($id);exit();

        switch($jenis) {
            case 'ddigital':
                $url = Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/files/dokumendigital/' . 
                $model->id .'/'. $model->dd_mod_dokumen;
                break;
        }
        return '<iframe src="' . $url . '" width="100%" height="600"></iframe>';
    }

    /**
     * Finds the DdDokumenDigital model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DdDokumenDigital the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DokumenDigital::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
