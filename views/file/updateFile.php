<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\File $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'File',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->fid]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formFile', [
        'model' => $model,
    ]) ?>

</div>
