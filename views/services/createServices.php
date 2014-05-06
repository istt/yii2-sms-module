<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Services $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Services',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formServices', [
        'model' => $model,
    ]) ?>

</div>
