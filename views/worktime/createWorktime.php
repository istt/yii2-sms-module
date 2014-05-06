<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Worktime $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Worktime',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Worktimes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worktime-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formWorktime', [
        'model' => $model,
    ]) ?>

</div>
