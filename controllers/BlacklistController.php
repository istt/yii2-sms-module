<?php

namespace istt\sms\controllers;

use Yii;
use istt\sms\models\Blacklist;
use istt\sms\models\BlacklistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlacklistController implements the CRUD actions for Blacklist model.
 */
class BlacklistController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Blacklist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlacklistSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('indexBlacklist', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Blacklist model.
     * @param integer $fid
     * @param string $isdn
     * @return mixed
     */
    public function actionView($fid, $isdn)
    {
        return $this->render('viewBlacklist', [
            'model' => $this->findModel($fid, $isdn),
        ]);
    }

    /**
     * Creates a new Blacklist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blacklist;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fid' => $model->fid, 'isdn' => $model->isdn]);
        } else {
            return $this->render('createBlacklist', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Blacklist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $fid
     * @param string $isdn
     * @return mixed
     */
    public function actionUpdate($fid, $isdn)
    {
        $model = $this->findModel($fid, $isdn);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fid' => $model->fid, 'isdn' => $model->isdn]);
        } else {
            return $this->render('updateBlacklist', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Blacklist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $fid
     * @param string $isdn
     * @return mixed
     */
    public function actionDelete($fid, $isdn)
    {
        $this->findModel($fid, $isdn)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blacklist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $fid
     * @param string $isdn
     * @return Blacklist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fid, $isdn)
    {
        if (($model = Blacklist::findOne(['fid' => $fid, 'isdn' => $isdn])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
