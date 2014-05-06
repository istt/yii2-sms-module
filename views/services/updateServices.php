<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Services $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'Services',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formServices', [
        'model' => $model,
    ]) ?>

</div>
