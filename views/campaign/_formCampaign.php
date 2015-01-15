<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Collapse;
use kartik\widgets\Select2;
use istt\sms\models\Filter;
use yii\helpers\VarDumper;
use yii\helpers\ArrayHelper;
use istt\sms\models\Ftp;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Campaign $model
 * @var kartik\widgets\ActiveForm $form
 */
?>

<div class="campaign-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $this->beginBlock('basic'); // Campaign basic information ?>

    	<div class="row">
    		<div class="col-md-9">
		    	<?= $form->field($model, 'title', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]])->textInput(['maxlength' => 40]) ?>

				<?= $form->field($model, 'codename', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-barcode"></i>']]])->textInput(['maxlength' => 20]) ?>

    		</div>
    		<div class="col-md-3">

		    	<?= $form->field($model, 'status', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-heart"></i>']]])
		    			->dropDownList(['Disable', 'Enable']) ?>

		    	<?= $form->field($model, 'approved', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-ok"></i>']]])
		    			->dropDownList(['Pending', 'Approved']) ?>


    		</div>
    	</div>

    	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    	<?= $form->field($model, 'orderid')->textInput() ?>

    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('meta'); // Campaign meta information ?>

		    <?= $form->field($model, 'datasender')->textInput(['maxlength' => 80]) ?>

		    <?= $form->field($model, 'tosubscriber')->textarea(['rows' => 6]) ?>

    	    <?= $form->field($model, 'request_owner')->textInput(['maxlength' => 40]) ?>

		    <?= $form->field($model, 'request_date')->textInput() ?>

    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('setting'); ?>

    	<?= $form->field($model, 'throughput')->textInput() ?>

	    <?= $form->field($model, 'priority')->textInput() ?>

	    <?= $form->field($model, 'velocity')->textInput() ?>

    	<?= $form->field($model, 'sender')->textInput(['maxlength' => 20]) ?>

    	<?= $form->field($model, 'template')->textarea(['rows' => 6]) ?>

    	<?= $form->field($model, 'col')->textInput() ?>

    	<?= $form->field($model, 'isdncol')->textInput() ?>

    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('data'); // Data retrieved from FTP server or file upload?>

    	<?= $form->field($model, 'ftpserver')->widget(Select2::className(), [
    			'data' => ($fptList = [null => Yii::t('sms', '-- Select FTP Connection --')] + ArrayHelper::map(Ftp::find()->all(), 'id', 'title'))
    	]) ?>

    	<?= $form->field($model, 'filterBlacklistIds')->widget(Select2::className(), [
    			'options'=> ['multiple' => true],
    			'data' => ($filterList = ArrayHelper::map(Filter::find()->all(), 'id', 'title'))
    	])?>
    	<?= $form->field($model, 'filterWhitelistIds')->widget(Select2::className(), [
    			'options'=> ['multiple' => true],
    			'data' => Filter::options(),
    	])?>

    <?php $this->endBlock(); ?>


    <?php $this->beginBlock('schedule'); ?>

    	<?= $form->field($model, 'start')->textInput() ?>

    	<?= $form->field($model, 'end')->textInput() ?>

    	<?= $form->field($model, 'emailbox')->textInput() ?>

    	<?= $form->field($model, 'exported')->textInput() ?>

    <?php $this->endBlock(); ?>

    <?php $this->beginBlock('advanced'); ?>

    	<?= $form->field($model, 'cpworkday')->textInput(['maxlength' => 10]) ?>

    	<?= $form->field($model, 'esubject')->textInput(['maxlength' => 255]) ?>

    	<?= $form->field($model, 'eattachment')->textInput(['maxlength' => 255]) ?>

    <?php $this->endBlock(); ?>


    <?= Collapse::widget([
    	'items' => [
    		['label' => Yii::t('sms', 'Basic'), 'content' => $this->blocks['basic'], 'contentOptions' => ['class' => 'in']],
    		['label' => Yii::t('sms', 'Metadata'), 'content' => $this->blocks['meta']],
    		['label' => Yii::t('sms', 'Setting'), 'content' => $this->blocks['setting']],
    		['label' => Yii::t('sms', 'Data'), 'content' => $this->blocks['data']],
    		['label' => Yii::t('sms', 'Schedule'), 'content' => $this->blocks['schedule']],
    		['label' => Yii::t('sms', 'Advanced'), 'content' => $this->blocks['advanced']],
    	]
    ])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

     <?= $form->field($model, 'smsimport')->textInput(['maxlength' => 20]) ?>
    <?= $form->field($model, 'blockimport')->textInput() ?>
    <?= $form->field($model, 'limit_exceeded')->textInput() ?>
    <?= $form->field($model, 'send')->textInput(['maxlength' => 20]) ?>
    <?= $form->field($model, 'blocksend')->textInput(['maxlength' => 20]) ?>
    <?= $form->field($model, 'sent')->textInput(['maxlength' => 20]) ?>
    <?= $form->field($model, 'blocksent')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'createtime')->textInput() ?>
    <?= $form->field($model, 'updatetime')->textInput() ?>

    <?= $form->field($model, 'finished')->textInput() ?>
    <?= $form->field($model, 'active')->textInput() ?>
    <?= $form->field($model, 'ready')->textInput() ?>
    <?= $form->field($model, 'org')->textInput() ?>
    <?= $form->field($model, 'type')->textInput() ?>

    <?php ActiveForm::end(); ?>

</div>


<?= VarDumper::dump($model, 2, true)?>
