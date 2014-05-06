<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\User $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'User',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUser', [
        'model' => $model,
    ]) ?>

</div>
