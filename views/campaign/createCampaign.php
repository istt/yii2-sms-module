<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Campaign $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Campaign',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Campaigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campaign-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formCampaign', [
        'model' => $model,
    ]) ?>

</div>
