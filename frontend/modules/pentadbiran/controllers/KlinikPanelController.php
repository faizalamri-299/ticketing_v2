<?php

namespace frontend\modules\pentadbiran\controllers;

use Yii;
use frontend\modules\pentadbiran\models\KlinikPanel;
use frontend\modules\pentadbiran\models\KlinikPanelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KlinikPanelController implements the CRUD actions for KlinikPanel model.
 */
class KlinikPanelController extends Controller
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
     * Lists all KlinikPanel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KlinikPanelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KlinikPanel model.
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
     * Creates a new KlinikPanel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KlinikPanel();

        if ($model->load(Yii::$app->request->post()) ) {
            if($model->save()){
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Pendaftaran Berjaya',
                    'text' => 'Pendaftaran Klinik Panel Berjaya! ',
                    'confirmButtonText' => 'Done!',
                ]
             ]);

            }else{
                
            }
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KlinikPanel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            if($model->save()){
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Kemaskini Berjaya',
                    'text' => 'Maklumat Klinik Panel Berjaya Dikemaskini! ',
                    'confirmButtonText' => 'Done!',
                ]
             ]);

            }else{
                
            }
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KlinikPanel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);      
            if($model->delete()){
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Maklumat Berjaya Dipadam!',
                    'text' => 'Maklumat Klinik Panel Berjaya Dipadam! ',
                    'confirmButtonText' => 'Done!',
                ]
             ]);

            }else{
                
            }
            return $this->redirect(['index', 'id' => $model->id]);

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
        // return $this->redirect(['index']);
    }

    /**
     * Finds the KlinikPanel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KlinikPanel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KlinikPanel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
