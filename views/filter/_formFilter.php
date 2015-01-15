<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use istt\sms\models\Ftp;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Filter $model
 * @var kartik\widgets\ActiveForm $form
 */
?>

<div class="filter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]])->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])?>

    <div class="row">
	<div class="col-sm-6">
	    <?= $form->field($model, 'reply_refuse')->textarea(['rows' => 3]) ?>
    	<?= $form->field($model, 'reply_refuse_dup')->textarea(['rows' => 3]) ?>
	    <?= $form->field($model, 'ftpblack')->widget(Select2::className(), [
	    		'data' => ($ftpList = [null => Yii::t('sms', '-- Select FTP Connection --')] + ArrayHelper::map(Ftp::find()->all(), 'id', 'title'))
	    ]) ?>
	    <?= $form->field($model, 'ftpblackfile')->textInput(['maxlength' => 255]) ?>

	</div>
	<div class="col-sm-6">
	    <?= $form->field($model, 'reply_accept')->textarea(['rows' => 3]) ?>
	    <?= $form->field($model, 'reply_accept_dup')->textarea(['rows' => 3]) ?>
	    <?= $form->field($model, 'ftpwhite')->widget(Select2::className(), [
	    		'data' => $ftpList
	    ]) ?>
	    <?= $form->field($model, 'ftpwhitefile')->textInput(['maxlength' => 255]) ?>

	</div>
</div>











    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
