<?php

namespace frontend\modules\pentadbiran\controllers;

use Yii;
use frontend\modules\pentadbiran\models\KakitanganHasJawatan;
use frontend\modules\pentadbiran\models\KakitanganHasJawatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KakitanganHasJawatanController implements the CRUD actions for KakitanganJawatan model.
 */

class KakitanganHasJawatanController extends Controller
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
     * Lists all Kakitangan Has Jawatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KakitanganHasJawatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kakitangan Has Jawatan model.
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
     * Creates a new Kakitangan Has Jawatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KakitanganHasJawatan();

        if ($model->load(Yii::$app->request->post())) {
        	if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        	}else{
        		echo "error"
        	}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kakitangan Has Jawatan model
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
     * Deletes an existing Kakitangan Has Jawatan model
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

    public function actionCuti()
    {
        $out = [];
        
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            
            if ($parents != null) {
                $kakitanganId = $parents[0];
                $out = PermohonanCuti::getKodCutiDepDrop($kakitanganId); 
                
                \Yii::$app->response->data = Json::encode(['output'=>$out, 'selected'=>'']);

                return;
            }
        }  

        \Yii::$app->response->data = Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Finds the Kakitangan Has Jawatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PasanganKakitangan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KakitanganHasJawatan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionJawatan()
    {
        $out = [];
        
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            
            if ($parents != null) {
                $unitId = $parents[0];
                $out = KakitanganHasJawatan::getJawatanDepDrop($unitId); 
                
                \Yii::$app->response->data = Json::encode(['output'=>$out, 'selected'=>'']);

                return;
            }
        }
        
        \Yii::$app->response->data = Json::encode(['output'=>'', 'selected'=>'']);
    }
}
