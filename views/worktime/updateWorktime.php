<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\Worktime $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'Worktime',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Worktimes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="worktime-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formWorktime', [
        'model' => $model,
    ]) ?>

</div>
