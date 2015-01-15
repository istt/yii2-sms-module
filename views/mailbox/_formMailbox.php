<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use istt\sms\models\Mailbox;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Mailbox $model
 * @var kartik\widgets\ActiveForm $form
 */
?>

<div class="mailbox-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
		<div class="col-sm-4">

		    <?= $form->field($model, 'hostname', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-hdd"></i>']]])->textInput(['maxlength' => 40]) ?>

		    <?= $form->field($model, 'email', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-envelope"></i>']]])->textInput(['maxlength' => 255]) ?>

		    <?= $form->field($model, 'password', ['addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-lock"></i>']]])->passwordInput(['maxlength' => 255]) ?>

		</div>
		<div class="col-sm-8">

	    	<?= $form->field($model, 'option')->checkBoxList(Mailbox::optionOption()) ?>

		</div>
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
