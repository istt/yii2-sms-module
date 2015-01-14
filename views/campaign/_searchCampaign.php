<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\CampaignSearch $model
 * @var kartik\widgets\ActiveForm $form
 */
?>

<div class="campaign-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'createtime') ?>

    <?= $form->field($model, 'updatetime') ?>

    <?php // echo $form->field($model, 'codename') ?>

    <?php // echo $form->field($model, 'request_date') ?>

    <?php // echo $form->field($model, 'request_owner') ?>

    <?php // echo $form->field($model, 'datasender') ?>

    <?php // echo $form->field($model, 'tosubscriber') ?>

    <?php // echo $form->field($model, 'start') ?>

    <?php // echo $form->field($model, 'end') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'finished') ?>

    <?php // echo $form->field($model, 'approved') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'sender') ?>

    <?php // echo $form->field($model, 'ready') ?>

    <?php // echo $form->field($model, 'org') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'throughput') ?>

    <?php // echo $form->field($model, 'col') ?>

    <?php // echo $form->field($model, 'isdncol') ?>

    <?php // echo $form->field($model, 'template') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'velocity') ?>

    <?php // echo $form->field($model, 'cpworkday') ?>

    <?php // echo $form->field($model, 'emailbox') ?>

    <?php // echo $form->field($model, 'esubject') ?>

    <?php // echo $form->field($model, 'eattachment') ?>

    <?php // echo $form->field($model, 'ftpserver') ?>

    <?php // echo $form->field($model, 'smsimport') ?>

    <?php // echo $form->field($model, 'blockimport') ?>

    <?php // echo $form->field($model, 'limit_exceeded') ?>

    <?php // echo $form->field($model, 'send') ?>

    <?php // echo $form->field($model, 'blocksend') ?>

    <?php // echo $form->field($model, 'sent') ?>

    <?php // echo $form->field($model, 'blocksent') ?>

    <?php // echo $form->field($model, 'orderid') ?>

    <?php // echo $form->field($model, 'exported') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sms', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sms', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
