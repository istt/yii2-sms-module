<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Collapse;
use kartik\widgets\Select2;
use istt\sms\models\Filter;
use yii\helpers\VarDumper;
use yii\helpers\ArrayHelper;
use istt\sms\models\Ftp;
use kartik\widgets\StarRating;
use kartik\widgets\DateTimePicker;
use kartik\widgets\TouchSpin;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use istt\sms\models\Worktime;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Campaign $model
 * @var kartik\widgets\ActiveForm $form
 */
?>

<div class="campaign-form">

    <?php $form = ActiveForm::begin([ 'options'=>['enctype'=>'multipart/form-data']]); ?>

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

<div class="row">
	<div class="col-sm-6">

    	<?= $form->field($model, 'start')->widget(DateTimePicker::className()) ?>

    	<?= $form->field($model, 'end')->widget(DateTimePicker::className()) ?>

    	<?= $form->field($model, 'formWorktimes')->widget(Select2::className(), [
    			'data' => ArrayHelper::map(Worktime::find()->all(), 'key', 'key'),
    			'options'=> ['multiple' => true],
    	])?>

	</div>
	<div class="col-sm-6">

    	<?= $form->field($model, 'formWeekday')->checkBoxList([
    			1	=>	Yii::t('app', "Sunday"),
				2	=>	Yii::t('app', "Monday"),
				3	=>	Yii::t('app', "Tuesday"),
				4	=>	Yii::t('app', "Wednesday"),
				5	=>	Yii::t('app', "Thursday"),
				6	=>	Yii::t('app', "Friday"),
				7	=>	Yii::t('app', "Saturday"),
    	]) ?>
	</div>
</div>




<div class="row">
	<div class="col-md-9 col-sm-6">
		    <?= $form->field($model, 'datasender')->textInput(['maxlength' => 80]) ?>
		    <?= $form->field($model, 'tosubscriber')->textInput(['maxlength' => 255]) ?>
	</div>
	<div class="col-md-3 col-sm-6">
    	    <?= $form->field($model, 'request_owner')->textInput(['maxlength' => 40]) ?>
		    <?= $form->field($model, 'request_date')->widget(DatePicker::className()) ?>

	</div>
</div>


<div class="row">
	<div class="col-sm-8">
	    <?= $form->field($model, 'priority')->widget(StarRating::className()) ?>

	</div>
	<div class="col-sm-4">
    	<?= $form->field($model, 'throughput')->widget(TouchSpin::className()) ?>

	    <?= $form->field($model, 'velocity')->widget(TouchSpin::className()) ?>
	</div>
</div>

<div class="row">
			<div class="col-sm-4">
		    	<?= $form->field($model, 'col')->widget(TouchSpin::className()) ?>
		    	<?= $form->field($model, 'isdncol')->widget(TouchSpin::className()) ?>

			</div>
			<div class="col-sm-8">
		    	<?= $form->field($model, 'sender')->textInput(['maxlength' => 20]) ?>
		    	<?= $form->field($model, 'template')->textarea(['rows' => 6]) ?>

			</div>
</div>
<hr/>
<div class="row">
	<div class="col-sm-6">
		<?= $form->field($model, 'formUploadFiles[]')->widget(FileInput::className(),[
				'options' => ['multiple' => true],
		]) ?>

	</div>
	<div class="col-sm-6">
    	<?= $form->field($model, 'ftpserver')->widget(Select2::className(), [
    			'data' => ($fptList = [null => Yii::t('sms', '-- Select FTP Connection --')] + ArrayHelper::map(Ftp::find()->all(), 'id', 'title'))
    	]) ?>

    	<?= $form->field($model, 'formFtpFiles')->textarea(['rows' => 6])?>
	</div>
</div>

<hr/>
<div class="row">
	<div class="col-sm-6">
    	<?= $form->field($model, 'formBlacklist')->widget(Select2::className(), [
    			'options'=> ['multiple' => true],
    			'data' => ($filterList = ArrayHelper::map(Filter::find()->all(), 'id', 'title'))
    	])?>
    	<?= $form->field($model, 'formWhitelist')->widget(Select2::className(), [
    			'options'=> ['multiple' => true],
    			'data' => $filterList,
    	])?>

	</div>
	<div class="col-sm-6">

    	<?= $form->field($model, 'emailbox')->textInput() ?>

    	<?= $form->field($model, 'esubject')->textInput(['maxlength' => 255]) ?>

    	<?= $form->field($model, 'eattachment')->textInput(['maxlength' => 255]) ?>

	</div>
</div>




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

    <?= $form->field($model, 'finished')->textInput() ?>
    <?= $form->field($model, 'active')->textInput() ?>
    <?= $form->field($model, 'ready')->textInput() ?>
    <?= $form->field($model, 'org')->textInput() ?>
    <?= $form->field($model, 'type')->textInput() ?>
    <?= $form->field($model, 'exported')->textInput() ?>

    <?php ActiveForm::end(); ?>

</div>


<?= VarDumper::dump($model, 2, true)?>
