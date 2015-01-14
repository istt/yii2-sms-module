<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use istt\sms\models\Filter;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Whitelist $model
 * @var kartik\widgets\ActiveForm $form
 */
?>

<div class="whitelist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fid')->dropDownList(Filter::options()) ?>

    <?= $form->field($model, 'isdn')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sms', 'Create') : Yii::t('sms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
