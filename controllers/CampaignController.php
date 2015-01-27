<?php

namespace istt\sms\controllers;

use Yii;
use istt\sms\models\Campaign;
use istt\sms\models\CampaignSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use istt\sms\models\Cpfilter;

/**
 * CampaignController implements the CRUD actions for Campaign model.
 */
class CampaignController extends Controller
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
     * Lists all Campaign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CampaignSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('indexCampaign', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Campaign model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('viewCampaign', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Campaign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Campaign;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	/* Save related blacklist & whitelist filters  */
        	Cpfilter::deleteAll(['cid' => $model->primaryKey]);
        	foreach ($model->filterBlacklistIds as $fid){
        		$cpfilter = new Cpfilter();
        		$cpfilter->cid = $model->primaryKey;
        		$cpfilter->fid = $fid;
        		$cpfilter->type = 0;
        		$cpfilter->save();
        	}
        	foreach ($model->filterWhitelistIds as $fid){
        		$cpfilter = new Cpfilter();
        		$cpfilter->cid = $model->primaryKey;
        		$cpfilter->fid = $fid;
        		$cpfilter->type = 1;
        		$cpfilter->save();
        	}
        	/* TODO: Save uploaded files  */

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
        	/* Populate the list of Filter IDs into the model... */
        	$model->filterBlacklistIds = $model->filterWhitelistIds = [];
        	foreach ($model->getCpfilter()->all() as $cpfilter){
        		if ($cpfilter->type){
        			$model->filterWhitelistIds[] = $cpfilter->fid;
        		} else {
        			$model->filterBlacklistIds[] = $cpfilter->fid;
        		}
        	}
            return $this->render('createCampaign', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Campaign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('updateCampaign', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Campaign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Campaign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Campaign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Campaign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
