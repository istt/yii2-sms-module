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

    <?= $form->field($model, 'hostname')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'option')->checkBoxList(Mailbox::optionOption()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
