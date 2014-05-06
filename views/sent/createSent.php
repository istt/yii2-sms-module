<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Sent $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Sent',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Sent'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formSent', [
        'model' => $model,
    ]) ?>

</div>
