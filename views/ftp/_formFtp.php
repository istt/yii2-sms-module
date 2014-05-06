<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Ftp $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="ftp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hostname')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
