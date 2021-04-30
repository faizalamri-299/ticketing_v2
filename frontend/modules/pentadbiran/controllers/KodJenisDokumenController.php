<?php

namespace frontend\modules\pentadbiran\controllers;

use Yii;
use frontend\modules\pentadbiran\models\KodJenisDokumen;
use frontend\modules\pentadbiran\models\KodJenisDokumenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KodJenisDokumenController implements the CRUD actions for KodJenisDokumen model.
 */
class KodJenisDokumenController extends Controller
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
     * Lists all KodJenisDokumen models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $model = new KodJenisDokumen();

        if ($model->load(Yii::$app->request->post()) ) {
            if($model->save()){
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Pendaftaran Berjaya',
                    'text' => 'Pendaftaran Kod Dokumen Telah Berjaya ! :)',
                    'confirmButtonText' => 'Done!',
                ]]);
                
                $model = new KodJenisDokumen();
            }else{
                
            }
            return $this->redirect(['index', 'id' => $model->id]);
        }

        $searchModel = new KodJenisDokumenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single KodJenisDokumen model.
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
     * Creates a new KodJenisDokumen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KodJenisDokumen();

        if ($model->load(Yii::$app->request->post()) ) {
            if($model->save()){
                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                [
                    'title' => 'Your title',
                    'text' => 'Your message',
                    'confirmButtonText' => 'Done!',
                ]
             ]);

            }else{
                
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KodJenisDokumen model.
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
     * Deletes an existing KodJenisDokumen model.
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
     * Finds the KodJenisDokumen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KodJenisDokumen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KodJenisDokumen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
