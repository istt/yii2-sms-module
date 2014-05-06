<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Order $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Order',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formOrder', [
        'model' => $model,
    ]) ?>

</div>
