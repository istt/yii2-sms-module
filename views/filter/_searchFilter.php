<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\FilterSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="filter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'reply_refuse') ?>

    <?= $form->field($model, 'reply_accept') ?>

    <?= $form->field($model, 'reply_false_syntax') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'ftpblack') ?>

    <?php // echo $form->field($model, 'ftpblackfile') ?>

    <?php // echo $form->field($model, 'ftpwhite') ?>

    <?php // echo $form->field($model, 'ftpwhitefile') ?>

    <?php // echo $form->field($model, 'reply_accept_dup') ?>

    <?php // echo $form->field($model, 'reply_refuse_dup') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sms', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sms', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
