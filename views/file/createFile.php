<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\File $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'File',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formFile', [
        'model' => $model,
    ]) ?>

</div>
