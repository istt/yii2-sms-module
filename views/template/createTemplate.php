<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Template $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Template',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formTemplate', [
        'model' => $model,
    ]) ?>

</div>
