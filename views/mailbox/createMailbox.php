<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\Mailbox $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Mailbox',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Mailboxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailbox-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formMailbox', [
        'model' => $model,
    ]) ?>

</div>
