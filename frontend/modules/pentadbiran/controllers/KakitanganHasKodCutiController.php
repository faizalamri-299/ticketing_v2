<?php

namespace frontend\modules\pentadbiran\controllers;

use Yii;
use frontend\modules\pentadbiran\models\KakitanganHasKodCuti;
use frontend\modules\pentadbiran\models\KakitanganHasKodCutiSearch;
use frontend\modules\pentadbiran\models\PermohonanCuti;
use frontend\modules\pentadbiran\models\PermohonanCutiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * KakitanganHasKodCutiController implements the CRUD actions for KakitanganHasKodCuti model.
 */
class KakitanganHasKodCutiController extends Controller
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
     * Lists all KakitanganHasKodCuti models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new KakitanganHasKodCutiSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = KakitanganHasKodCuti::find()
            ->select(['makc_fk_maklumat_anggota_id'])
            ->DISTINCT();

        $dataProvider = new ActiveDataProvider([

                'query' => $query,

                ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single KakitanganHasKodCuti model.
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
     * Creates a new KakitanganHasKodCuti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionViewKakitangan($id)
    {
        $model = KakitanganHasKodCuti::find()
            ->where(['makc_fk_maklumat_anggota_id' => $id])
            ->one();
        $searchModel = new KakitanganHasKodCutiSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = KakitanganHasKodCuti::find()
            ->where(['makc_fk_maklumat_anggota_id' => $id])
            ->DISTINCT();

        //var_dump($query);exit();
        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => 
                            ['makc_mod_tahun' => SORT_ASC,
                            'makc_fk_kod_cuti_id' => SORT_ASC],
                    ],

                ]);

        return $this->render('_maklumatCutiKakitangan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);

    }
    public function actionCreate()
    {
        $model = new KakitanganHasKodCuti();
        //$modelCuti = new PermohonanCuti();
        
      
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                //baki cuti equal to jumlah cuti in kakitanganHasKodCuti
                $model->makc_sys_baki_cuti = $model->makc_mod_jumlah_cuti;

                $bakiCuti = $model->makc_sys_baki_cuti;
        
                $model->makc_sys_baki_cuti = $bakiCuti;

                $model->save();

                return $this->redirect(['view-kakitangan', 'id' => $model->makc_fk_maklumat_anggota_id]);
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KakitanganHasKodCuti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->makc_sys_baki_cuti = $model->makc_mod_jumlah_cuti;

            $bakiCuti = $model->makc_sys_baki_cuti;


            $model->makc_sys_baki_cuti = $bakiCuti;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KakitanganHasKodCuti model.
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

    /**
     * Finds the KakitanganHasKodCuti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KakitanganHasKodCuti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KakitanganHasKodCuti::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
}
