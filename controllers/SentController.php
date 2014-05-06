<?php

namespace istt\sms\controllers;

use Yii;
use istt\sms\models\Sent;
use istt\sms\models\SentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SmsController implements the CRUD actions for Sms model.
 */
class SentController extends Controller
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
     * Lists all Sms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SentSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('indexSent', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Sms model.
     * @param string $receiver
     * @param integer $campaign_id
     * @return mixed
     */
    public function actionView($receiver, $campaign_id)
    {
        return $this->render('viewSent', [
            'model' => $this->findModel($receiver, $campaign_id),
        ]);
    }

    /**
     * Creates a new Sms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sms;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'receiver' => $model->receiver, 'campaign_id' => $model->campaign_id]);
        } else {
            return $this->render('createSms', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $receiver
     * @param integer $campaign_id
     * @return mixed
     */
    public function actionUpdate($receiver, $campaign_id)
    {
        $model = $this->findModel($receiver, $campaign_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'receiver' => $model->receiver, 'campaign_id' => $model->campaign_id]);
        } else {
            return $this->render('updateSms', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $receiver
     * @param integer $campaign_id
     * @return mixed
     */
    public function actionDelete($receiver, $campaign_id)
    {
        $this->findModel($receiver, $campaign_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $receiver
     * @param integer $campaign_id
     * @return Sms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($receiver, $campaign_id)
    {
        if (($model = Sms::findOne(['receiver' => $receiver, 'campaign_id' => $campaign_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
