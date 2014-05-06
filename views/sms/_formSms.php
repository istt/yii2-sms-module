<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\Sms $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'momt')->textInput() ?>

    <?= $form->field($model, 'udhdata')->textInput() ?>

    <?= $form->field($model, 'msgdata')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'meta_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sms_type')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'mclass')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'mwi')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'coding')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'compress')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'validity')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'deferred')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'dlr_mask')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'pid')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'alt_dcs')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'rpi')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'campaign_id')->textInput() ?>

    <?= $form->field($model, 'sender')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'receiver')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'smsc_id')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'service')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'dlr_url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'charset')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'boxc_id')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'binfo')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
