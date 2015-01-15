<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use istt\sms\models\User;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Order $model
 * @var kartik\widgets\ActiveForm $form
 */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-md-9">
			    	<?= $form->field($model, 'title', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]])->textInput(['maxlength' => 255]) ?>
		</div>
	   	<div class="col-md-3">
				    <?= $form->field($model, 'status', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-heart"></i>']]])->dropDownList(['No', 'Yes']) ?>
		</div>
	</div>
	 <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
    <div class="row">
    	<div class="col-md-3">
		    <?= $form->field($model, 'userid', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-user"></i>']]])->widget(Select2::className(), [
		    		'data' => ($userList = ArrayHelper::map(User::find()->where(['status' => 1])->all(), 'id', 'username'))
		    ]) ?>

		    <?= $form->field($model, 'expired')->widget(DatePicker::className()) ?>

	    	<?= $form->field($model, 'smscount', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-shopping-cart"></i>']]])->textInput(['maxlength' => 20]) ?>

    	</div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
