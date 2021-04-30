<?php

namespace frontend\modules\pesakit\controllers;

use Yii;
use frontend\modules\pesakit\models\Pesakit;
use frontend\modules\pesakit\models\PesakitSearch;
use frontend\modules\tempahan\models\Tempahan;
use frontend\modules\bantuan\models\Bantuan;
use frontend\modules\pesakit\models\Penjaga;
use frontend\modules\pesakit\models\AhliKeluarga;
use frontend\modules\pesakit\models\Sosioekonomi;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use frontend\models\Hospital;
use yii\helpers\Json;
use yii\web\UploadedFile;
use common\models\UploadImage;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

use yii\helpers\Html;
use yii\web\Response;

/**
 * PesakitController implements the CRUD actions for Pesakit model.
 */
class PesakitController extends Controller
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
     * Lists all Pesakit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PesakitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pesakit model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $queryTempahan = Tempahan::find()
            ->where(['tph_fk_psk_id' => $id])
            ->orderBy(['tph_mod_tarikh_masuk'=>SORT_DESC]);

        $dataProviderTempahan = new ActiveDataProvider([
            'query' => $queryTempahan,
            'pagination' => false
        ]);
        
        $dataBantuanAlt = Bantuan::find()
            ->where(['btn_fk_psk_id' => $id])
            ->orderBy(['btn_sys_tarikh_masuk'=>SORT_DESC])->all();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProviderTempahan' => $dataProviderTempahan,
            'dataBantuanAlt'=>$dataBantuanAlt,
        ]);
    }

    /**
     * Creates a new Pesakit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idPsk = NULL, $tab = 1)
    {

        $modelPjg = new Penjaga();
        $modelAk = new AhliKeluarga();
        $modelSe = new Sosioekonomi();

        if(empty($idPsk)) {
            $model = new Pesakit();
        } else {
            $model = $this->findModel($idPsk);
            $queryPenjaga = Penjaga::find()->where(['pjg_fk_psk_id' => $idPsk]);
            $queryAhliKeluarga = AhliKeluarga::find()->where(['ak_fk_psk_id' => $idPsk]);    
        }

        if($model->load(Yii::$app->request->post())){

            $model->psk_mod_status = 1;
            $tempImage = UploadedFile::getInstance($model, 'tempImage');

            if($model->save(false)){
                // Upload image
                if ($modelImage->imageFiles = $tempImage) {
                    
                    // file is uploaded successfully
                    $modelImage->upload($model->id, 'pesakit');

                }
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'Berjaya',
                        'text' => 'Maklumat pesakit telah disimpan ke dalam pangkalan data',
                        'confirmButtonText' => 'Ok!',
                        'timer' => 2000,
                    ],
                    [
                    'callback' => new \yii\web\JsExpression("
                        function (result) {
                            // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
                            if (result.dismiss === 'timer') {
                                console.log('I was closed by the timer')
                            }
                        }
                    "),
                    ],
                 ]);
            }

            return $this->redirect(['create', 'tab' => 2]);

        }elseif($modelPjg->load(Yii::$app->request->post())){

            $modelPjg->pjg_fk_psk_id = $model->id;
            $modelPjg->save();

            return $this->redirect(['create', 'tab' => 2]);

        }elseif($modelAk->load(Yii::$app->request->post())){

            $modelAk->ak_fk_psk_id = $model->id;
            $modelAk->save();

            return $this->redirect(['create', 'tab' => 2]);
        }



        return $this->render('create', [
            'model' => $model,
            'modelPjg' => $modelPjg,
            'modelAk' => $modelAk,
            'dataProvider' => $dataProviderPenjaga,
            'tab' => $tab,
        ]);
    }

    /**
     * Updates an existing Pesakit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelImage = new UploadImage();
        ini_set('memory_limit', '-1');

        if ($model->load(Yii::$app->request->post())) {
             $tempImage = UploadedFile::getInstance($model, 'tempImage');

            if($model->save()){
                if(!empty($tempImage)) {
                    // Upload image
                    if ($modelImage->imageFiles = $tempImage) {
                        
                        // file is uploaded successfully
                        $modelImage->upload($model->id, 'pesakit');

                    }
                }
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'Berjaya',
                        'text' => 'Maklumat pesakit telah dikemaskini dan disimpan ke dalam pangkalan data',
                        'confirmButtonText' => 'Ok!',
                        'timer' => 2000,
                    ],
                    [
                    'callback' => new \yii\web\JsExpression("
                        function (result) {
                            // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
                            if (result.dismiss === 'timer') {
                                console.log('I was closed by the timer')
                            }
                        }
                    "),
                    ],
                ]);

            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pesakit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
            [
                'title' => 'Berjaya',
                'text' => 'Maklumat pesakit telah berjaya dipadam',
                'confirmButtonText' => 'Ok!',
                'timer' => 2000,
            ],
            [
            'callback' => new \yii\web\JsExpression("
                function (result) {
                    // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
                    if (result.dismiss === 'timer') {
                        console.log('I was closed by the timer')
                    }
                }
            "),
        ],
         ]);

        return $this->redirect(['index']);
    }

    public function actionKemaskini()
    {
        $model = new Pesakit();

        if($model->load(Yii::$app->request->get())) {

            $queryCarian = Pesakit::find()
                ->where(['psk_mod_no_kp' => $model->psk_mod_no_kp]);

            $dataProviderCarian = new ActiveDataProvider([
                'query' => $queryCarian,
                'pagination' => false
            ]);
        } else {
            $dataProviderCarian = NULL;
        }

        return $this->render('kemaskini', [
            'model' => $model,
            'dataProviderCarian' => $dataProviderCarian,
        ]);
    }

    public function actionCarian()
    {
        $model = new Pesakit();

        if($model->load(Yii::$app->request->get())) {

            $queryCarian = Pesakit::find()
                ->where(['psk_mod_no_kp' => $model->psk_mod_no_kp]);

            $dataProviderCarian = new ActiveDataProvider([
                'query' => $queryCarian,
                'pagination' => false
            ]);
        } else {
            $dataProviderCarian = NULL;
        }

        return $this->render('carian', [
            'model' => $model,
            'dataProviderCarian' => $dataProviderCarian,
        ]);
    }

    public function actionInactive()
    {
        $model = new Pesakit();

        if($model->load(Yii::$app->request->get())) {

            $queryCarian = Pesakit::find()
                ->where(['psk_mod_no_kp' => $model->psk_mod_no_kp]);

            $dataProviderCarian = new ActiveDataProvider([
                'query' => $queryCarian,
                'pagination' => false
            ]);
        } else {
            $dataProviderCarian = NULL;
        }

        return $this->render('inactive', [
            'model' => $model,
            'dataProviderCarian' => $dataProviderCarian,
        ]);
    }

    public function actionNyahaktif($id)
    {
        $model = Pesakit::findOne(['id'=>$id]);

        $model->psk_mod_status = 0;
        if($model->save()){
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Berjaya',
                    'text' => 'Maklumat pesakit telah berjaya dinyahaktifkan',
                    'confirmButtonText' => 'Ok!',
                    'timer' => 2000,
                ],
                [
                'callback' => new \yii\web\JsExpression("
                    function (result) {
                        // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
                        if (result.dismiss === 'timer') {
                            console.log('I was closed by the timer')
                        }
                    }
                "),
                ],
            ]);

        }

        return $this->redirect(['view', 'id' => $model->id]);

    }

    public function actionAktif($id)
    {
        $model = Pesakit::findOne(['id'=>$id]);

        $model->psk_mod_status = 1;
        if($model->save()){
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Berjaya',
                    'text' => 'Maklumat pesakit telah berjaya diaktifkan',
                    'confirmButtonText' => 'Ok!',
                    'timer' => 2000,
                ],
                [
                'callback' => new \yii\web\JsExpression("
                    function (result) {
                        // handle dismiss, result.dismiss can be 'cancel', 'overlay', 'close', and 'timer'
                        if (result.dismiss === 'timer') {
                            console.log('I was closed by the timer')
                        }
                    }
                "),
                ],
            ]);

        }

        return $this->redirect(['view', 'id' => $model->id]);

    }

    // get maklumat pesakit 
    // added by Rasnan
    public function actionGetMaklumatPesakit($psk_mod_no_kp) { 

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $pesakit = Pesakit::find()->joinWith('kodNegeri')->where(['psk_mod_no_kp' => $psk_mod_no_kp])->asArray()->one();
        return $pesakit;
    }

    public function actionGetPesakit($psk_mod_no_kp = NULL) { 
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if(isset($psk_mod_no_kp))
        {
            $pesakit = Pesakit::find()
                ->joinWith('kodNegeri')
                ->where(['psk_mod_no_kp' => $psk_mod_no_kp])
                ->asArray()
                ->one();
        }
        else
        {
            $pesakit = Pesakit::find()
                ->joinWith('kodNegeri')
                ->asArray()
                ->all();
        }
        
        return $pesakit;
    }

    /**
     * Finds the Pesakit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pesakit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pesakit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}