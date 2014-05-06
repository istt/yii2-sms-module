<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\Mailbox $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'Mailbox',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Mailboxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="mailbox-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formMailbox', [
        'model' => $model,
    ]) ?>

</div>
