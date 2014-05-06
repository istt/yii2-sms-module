<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Whitelist $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Whitelist',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Whitelists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="whitelist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formWhitelist', [
        'model' => $model,
    ]) ?>

</div>
