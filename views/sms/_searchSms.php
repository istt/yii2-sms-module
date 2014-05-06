<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\SmsSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'momt') ?>

    <?= $form->field($model, 'sender') ?>

    <?= $form->field($model, 'receiver') ?>

    <?= $form->field($model, 'udhdata') ?>

    <?= $form->field($model, 'msgdata') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'smsc_id') ?>

    <?php // echo $form->field($model, 'service') ?>

    <?php // echo $form->field($model, 'account') ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'sms_type') ?>

    <?php // echo $form->field($model, 'mclass') ?>

    <?php // echo $form->field($model, 'mwi') ?>

    <?php // echo $form->field($model, 'coding') ?>

    <?php // echo $form->field($model, 'compress') ?>

    <?php // echo $form->field($model, 'validity') ?>

    <?php // echo $form->field($model, 'deferred') ?>

    <?php // echo $form->field($model, 'dlr_mask') ?>

    <?php // echo $form->field($model, 'dlr_url') ?>

    <?php // echo $form->field($model, 'pid') ?>

    <?php // echo $form->field($model, 'alt_dcs') ?>

    <?php // echo $form->field($model, 'rpi') ?>

    <?php // echo $form->field($model, 'charset') ?>

    <?php // echo $form->field($model, 'boxc_id') ?>

    <?php // echo $form->field($model, 'binfo') ?>

    <?php // echo $form->field($model, 'meta_data') ?>

    <?php // echo $form->field($model, 'campaign_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sms', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sms', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
