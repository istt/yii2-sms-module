<?php

namespace istt\sms\controllers;

use Yii;
use istt\sms\models\Campaign;
use istt\sms\models\CampaignSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use istt\sms\models\Cpfilter;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use yii\web\HttpException;
use istt\sms\models\File;
use istt\sms\models\Sms;
use istt\sms\models\Cpfile;

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

    public function actionNew(){
    	$model = new Campaign;
    	if ($model->load(Yii::$app->request->post()) && $model->validate()){
    		Yii::trace(VarDumper::dumpAsString($model));
    		$uploadedFiles = UploadedFile::getInstances($model, 'formUploadFiles');
    		foreach ($uploadedFiles as $file){
    			$filePath = "/tmp/" . $file->name;
    			if ($uploadedFiles instanceof UploadedFile){
    				$file->saveAs($filePath);
    			}
    		}
    		Yii::trace(VarDumper::dumpAsString($uploadedFiles));
    	} else {
    		$model->initForm();

    	}
    	return $this->render('createCampaign', [
    			'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	$model->attributes = $_POST['Campaign'];
			if ($model->emailbox) {
				$model->ready = Campaign::READY_ALL;
				$model->finished = Campaign::FINISHED_TRUE;
				$model->template = '';
			} else {
				$model->finished = Campaign::FINISHED_FALSE;
				$model->ready = Campaign::READY_NOTYET;
			}
			if ($model->save()){
				$fileModel = new File();
				$fileModel->setFileInstance($file, $model->getDirectory());
				$fileModel->save();
				$cpfile = new Cpfile();
				$cpfile->cid = $model->id;
				$cpfile->fid = $fileModel->fid;
				$cpfile->save();
			}
			// Allow user to choose Existing Files...
			$cpf = [];
			if (! empty($_POST['Campaign']['cpf']) && is_array($cpf = $_POST['Campaign']['cpf']))
				foreach ($cpf as $fid) {
					if (empty($fid)) continue;
					$n = new Cpfile();
					$n->cid = $model->id;
					$n->fid = $fid;
					$n->save();
				}

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

        if ($model->finished == Campaign::FINISHED_TRUE)
        	throw new CHttpException(403, 'Chương trình này đã hoàn thành nên không thể sửa đổi được nữa.');
        if (!(Yii::$app->user->can('/sms/sms/admin')) && ($model->approved == Campaign::APPROVED_TRUE))
        	throw new CHttpException(403, 'Chương trình này đã được xét duyệt nên không thể sửa đổi được nữa.');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	$model->ready = Campaign::READY_NOTYET;
        	if ($model->save()){
        		if ($model->approved){
        			Sms::deleteAll(['campaign_id' => $model->id]);
        		}
        		Cpfile::updateAll(['status' => Cpfile::STATUS_NEW], ['cid' => $model->id]);
        		/* Handle Uploaded Files */
        		$datafiles = UploadedFile::getInstances($model, 'formUploadFiles');
        		foreach ($datafiles as $file) {
        			// FIXME: Check to see if this file already exists...
        			$fileModel = new File();
        			$fileModel->setFileInstance($file, $model->getDirectory());
        			$fileModel->save();
        			$cpfile = new Cpfile();
        			$cpfile->cid = $model->id;
        			$cpfile->fid = $fileModel->fid;
        			$cpfile->save();
        		}
        		/* Handle existing files */
        		$cpf = array();
        		if (! empty($_POST['Campaign']['cpf']) && is_array($cpf = $_POST['Campaign']['cpf'])){
        			foreach ($cpf as $fid) {
        				if (empty($fid)) continue;
        				$n = new Cpfile();
        				$n->cid = $model->id;
        				$n->fid = $fid;
        				$n->save();
        			}
        		}
        	}
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
        $model = $this->findModel($id);
        if (!(Yii::$app->user->can('sms/sms/admin')) && ($model->approved == Campaign::APPROVED_TRUE))
        	throw new HttpException(403, Yii::t('sms', 'Cannot delete Approved Campaign.'));
        if ($model->finished == Campaign::FINISHED_TRUE)
        	throw new CHttpException(403, Yii::t('sms', 'Cannot delete Finished Campaign.'));
        $model->delete();

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
