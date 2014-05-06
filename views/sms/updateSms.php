<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\Sms $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'Sms',
]) . ' ' . $model->receiver;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Sms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->receiver, 'url' => ['view', 'receiver' => $model->receiver, 'campaign_id' => $model->campaign_id]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="sms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formSms', [
        'model' => $model,
    ]) ?>

</div>
