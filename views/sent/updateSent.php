<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\Sent $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'Sent',
]) . ' ' . $model->receiver;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Sent'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->receiver, 'url' => ['view', 'receiver' => $model->receiver, 'campaign_id' => $model->campaign_id]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="sms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formSent', [
        'model' => $model,
    ]) ?>

</div>
