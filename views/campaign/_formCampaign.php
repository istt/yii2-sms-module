<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Campaign $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="campaign-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tosubscriber')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'template')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'createtime')->textInput() ?>

    <?= $form->field($model, 'updatetime')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'finished')->textInput() ?>

    <?= $form->field($model, 'approved')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'ready')->textInput() ?>

    <?= $form->field($model, 'org')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'throughput')->textInput() ?>

    <?= $form->field($model, 'col')->textInput() ?>

    <?= $form->field($model, 'isdncol')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'velocity')->textInput() ?>

    <?= $form->field($model, 'emailbox')->textInput() ?>

    <?= $form->field($model, 'ftpserver')->textInput() ?>

    <?= $form->field($model, 'smsimport')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'blockimport')->textInput() ?>

    <?= $form->field($model, 'limit_exceeded')->textInput() ?>

    <?= $form->field($model, 'send')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'blocksend')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sent')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'blocksent')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'orderid')->textInput() ?>

    <?= $form->field($model, 'exported')->textInput() ?>

    <?= $form->field($model, 'request_date')->textInput() ?>

    <?= $form->field($model, 'start')->textInput() ?>

    <?= $form->field($model, 'end')->textInput() ?>

    <?= $form->field($model, 'cpworkday')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'request_owner')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'codename')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sender')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'datasender')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'esubject')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'eattachment')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
