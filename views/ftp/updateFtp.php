<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Ftp $model
 */

$this->title = Yii::t('sms', 'Update {modelClass}: ', [
  'modelClass' => 'Ftp',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Ftps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('sms', 'Update');
?>
<div class="ftp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formFtp', [
        'model' => $model,
    ]) ?>

</div>
