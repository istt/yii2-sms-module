<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\User $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'User',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUser', [
        'model' => $model,
    ]) ?>

</div>
