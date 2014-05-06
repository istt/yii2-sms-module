<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'activkey')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'createtime')->textInput() ?>

    <?= $form->field($model, 'lastvisit')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'org')->textInput() ?>

    <?= $form->field($model, 'sender')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'smsprefix')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
