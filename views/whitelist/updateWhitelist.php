<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\Whitelist $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'Whitelist',
]) . ' ' . $model->fid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Whitelists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fid, 'url' => ['view', 'fid' => $model->fid, 'isdn' => $model->isdn]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="whitelist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formWhitelist', [
        'model' => $model,
    ]) ?>

</div>
