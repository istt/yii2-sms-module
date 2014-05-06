<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Sms $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Sms',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Sms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formSms', [
        'model' => $model,
    ]) ?>

</div>
