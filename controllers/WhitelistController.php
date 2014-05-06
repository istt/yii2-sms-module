<?php

namespace istt\sms\controllers;

use Yii;
use istt\sms\models\Whitelist;
use istt\sms\models\WhitelistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WhitelistController implements the CRUD actions for Whitelist model.
 */
class WhitelistController extends Controller
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
     * Lists all Whitelist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WhitelistSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('indexWhitelist', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Whitelist model.
     * @param integer $fid
     * @param string $isdn
     * @return mixed
     */
    public function actionView($fid, $isdn)
    {
        return $this->render('viewWhitelist', [
            'model' => $this->findModel($fid, $isdn),
        ]);
    }

    /**
     * Creates a new Whitelist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Whitelist;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fid' => $model->fid, 'isdn' => $model->isdn]);
        } else {
            return $this->render('createWhitelist', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Whitelist model.
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
            return $this->render('updateWhitelist', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Whitelist model.
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
     * Finds the Whitelist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $fid
     * @param string $isdn
     * @return Whitelist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fid, $isdn)
    {
        if (($model = Whitelist::findOne(['fid' => $fid, 'isdn' => $isdn])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
