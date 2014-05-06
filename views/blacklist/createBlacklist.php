<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Blacklist $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Blacklist',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Blacklists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blacklist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formBlacklist', [
        'model' => $model,
    ]) ?>

</div>
