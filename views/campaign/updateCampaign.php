<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Campaign $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'Campaign',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Campaigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="campaign-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formCampaign', [
        'model' => $model,
    ]) ?>

</div>
