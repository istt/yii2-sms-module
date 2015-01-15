<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\VarDumper;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Ftp $model
 * @var kartik\widgets\ActiveForm $form
 */
?>

<div class="ftp-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
		<div class="col-md-8 col-sm-6">
		    <?= $form->field($model, 'title', [ 'addon' => [ 'prepend' =>[ 'content' => '<i class="glyphicon glyphicon-star"></i>' ] ] ])
		    		->textInput(['maxlength' => 255]) ?>
		    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'style' => 'height: 182px;']) ?>

		</div>

		<div class="col-md-4 col-sm-6">

		    <?= $form->field($model, 'hostname', [ 'addon' => [ 'prepend' =>[ 'content' => '<i class="glyphicon glyphicon-globe"></i>' ] ] ])->textInput(['maxlength' => 40]) ?>

		    <?= $form->field($model, 'path', [ 'addon' => [ 'prepend' =>[ 'content' => '<i class="glyphicon glyphicon-road"></i>' ] ] ])->textInput(['maxlength' => 255]) ?>

		    <?= $form->field($model, 'username', [ 'addon' => [ 'prepend' =>[ 'content' => '<i class="glyphicon glyphicon-user"></i>' ] ] ])->textInput(['maxlength' => 40]) ?>

    		<?= $form->field($model, 'password', [ 'addon' => [ 'prepend' =>[ 'content' => '<i class="glyphicon glyphicon-lock"></i>' ] ] ])->passwordInput(['maxlength' => 40]) ?>
		</div>
	</div>

	<hr/>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php VarDumper::dump($model, 10, true)?>