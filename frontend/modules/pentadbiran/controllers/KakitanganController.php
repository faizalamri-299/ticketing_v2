<?php

namespace frontend\modules\pentadbiran\controllers;

use Yii;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\KakitanganSearch;
use frontend\modules\pentadbiran\models\PasanganKakitangan;
use frontend\modules\pentadbiran\models\AnakKakitangan;
use frontend\modules\pentadbiran\models\KakitanganHasJawatan;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use common\models\UploadImage;

use yii\helpers\Json;
/**
 * KakitanganController implements the CRUD actions for Kakitangan model.
 */
class KakitanganController extends Controller
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
     * Lists all Kakitangan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KakitanganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kakitangan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView($id)
    {
        //View dalam tab dan cari data dari model pasangan dan model anak kakitangan
        $modelPsg = PasanganKakitangan::find()->where(['mp_fk_kakitangan_id' => $id])->one();
        $modelKakitangan = KakitanganHasJawatan::find()->where(['kajt_fk_kakitangan_id' => $id])->one();
        $queryAnak = AnakKakitangan::find()
            ->where(['man_fk_kakitangan_id' => $id]);
        $queryPerkhidmatan = KakitanganHasJawatan::find()
            ->where(['kajt_fk_kakitangan_id' => $id])->orderBy('id DESC');

        $dataProviderAnk = new ActiveDataProvider([
            'query' => $queryAnak,
            'pagination' => false
        ]);
        
        $dataProviderPerkhidmatan = new ActiveDataProvider([
            'query' => $queryPerkhidmatan,
            'pagination' => false
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelPsg' => $modelPsg,
            'modelAnk' => $modelAnk,
            'dataProviderAnk' => $dataProviderAnk,
            'dataProviderPerkhidmatan' => $dataProviderPerkhidmatan,
        ]);
    }

    /**
     * Creates a new Kakitangan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate($idKa = NULL, $tab = 1)
    {

        $modelPsg = new PasanganKakitangan();
        $modelAnk = new AnakKakitangan();
        $modelImage = new UploadImage();
        $modelPerkhidmatan = new KakitanganHasJawatan();


        //statement untuk semak id kakitangan
        if(empty($idKa)) 
        {
            $model = new Kakitangan();
            $modelPsg = new PasanganKakitangan();
        } 

        else
        {
            //daftar maklumat pasangan dan anak tapi guna id kakitangan
            $model = $this->findModel($idKa);
            $modelPsg = $modelPsg->findOne(['mp_fk_kakitangan_id' => $idKa]);
            if(!isset($modelPsg->id))
            {
                $modelPsg = new PasanganKakitangan();
            }
            
        }

       //Tab 1 [Profil]
        if($model->load(Yii::$app->request->post()))
        {
            $tempImage = UploadedFile::getInstance($model, 'tempImage');
            $model->ma_mod_tarikh_lahir = Yii::$app->formatter->asDate($model->ma_mod_tarikh_lahir, 'php:Y-m-d');
            if($model->save())
            {
                // Upload image
                if ($modelImage->imageFiles = $tempImage) {
                    
                    // file is uploaded successfully
                    $modelImage->upload($model->id, 'kakitangan');

                }
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'Berjaya',
                        'text' => 'Maklumat pekerja telah disimpan ke dalam pangkalan data',
                        'confirmButtonText' => 'Ok!',
                    ],
                 ]);
            }
            return $this->redirect(['create','idKa' => $model->id, 'tab' => 1]);

        }

        //Tab 2 [Pasangan]
        elseif($modelPsg->load(Yii::$app->request->post()))
        {
            $modelPsg->mp_mod_tarikh_lahir = Yii::$app->formatter->asDate($modelPsg->mp_mod_tarikh_lahir, 'php:Y-m-d');
            $modelPsg->mp_fk_kakitangan_id = $model->id;
            $modelPsg->save();
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'Berjaya',
                        'text' => 'Maklumat pasangan telah disimpan ke dalam pangkalan data',
                        'confirmButtonText' => 'Ok!',
                    ],
                 ]);
            return $this->redirect(['create','idKa' => $model->id, 'tab' => 2]);
        }

        //Tab 3 [Anak]
        elseif($modelAnk->load(Yii::$app->request->post()))
        {
            $modelAnk->man_mod_tarikh_lahir = Yii::$app->formatter->asDate($modelAnk->man_mod_tarikh_lahir, 'php:Y-m-d');
            $modelAnk->man_fk_kakitangan_id = $model->id;
            $modelAnk->save();
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'Berjaya',
                        'text' => 'Maklumat anak telah disimpan ke dalam pangkalan data',
                        'confirmButtonText' => 'Ok!',
                    ],
                 ]);
            return $this->redirect(['create','idKa' => $model->id, 'tab' => 3]);
        }   

        //Tab 4 [Perkhidmatan]
        elseif($modelPerkhidmatan->load(Yii::$app->request->post()))
        {
            
            $modelPerkhidmatan->kajt_mod_tarikh_lantikan = Yii::$app->formatter->asDate($modelPerkhidmatan->kajt_mod_tarikh_lantikan, 'php:Y-m-d');
            $modelPerkhidmatan->kajt_mod_tarikh_tamat = Yii::$app->formatter->asDate($modelPerkhidmatan->kajt_mod_tarikh_tamat, 'php:Y-m-d');
            $modelPerkhidmatan->kajt_mod_status_kakitangan = '1';
            $modelPerkhidmatan->kajt_fk_kakitangan_id = $model->id;
            $modelPerkhidmatan->save();
            Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'Berjaya',
                        'text' => 'Maklumat Perkhidmatan telah disimpan ke dalam pangkalan data',
                        'confirmButtonText' => 'Ok!',
                    ],
                 ]);
            return $this->redirect(['create','idKa' => $model->id, 'tab' => 4]);
        }  

        return $this->render('create', [
            'model' => $model,
            'modelPsg' => $modelPsg,
            'modelAnk' => $modelAnk,
            'modelPerkhidmatan' => $modelPerkhidmatan,
            'dataProviderAnk' => $dataProviderAnk,
            'dataProviderPerkhidmatan' => $dataProviderPerkhidmatan,
            'tab' => $tab,
            'idKa' => $idKa,
        ]);
    }

    /**
     * Updates an existing Kakitangan model.
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
            'modelPsg' => $modelPsg,
            'modelAnk' => $modelAnk,
            'modelPerkhidmatan' => $modelPerkhidmatan,
        ]);
    }

    /**
     * Deletes an existing Kakitangan model.
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

    //function delete anak dalam table
    public function actionDeleteAnak($id, $flag = null)
    {
        $modelAnk = new AnakKakitangan();
        $modelAnk = $modelAnk->findOne($id);

        if($modelAnk->delete())
        {
            return $this->redirect(['create', 'idKa' => $modelAnk->man_fk_kakitangan_id, 'tab' => 3 ]);
        }
    }

    
    //Function for dependent dropdown
    public function actionJawatan()
    {
        $out = [];
        
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            
            if ($parents != null) {
                $unitId = $parents[0];
                $out = Kakitangan::getJawatanDepDrop($unitId); 
                
                \Yii::$app->response->data = Json::encode(['output'=>$out, 'selected'=>'']);

                return;
            }
        }
        
        \Yii::$app->response->data = Json::encode(['output'=>'', 'selected'=>'']);
    }

    
    /**
     * Finds the Kakitangan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kakitangan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kakitangan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}


