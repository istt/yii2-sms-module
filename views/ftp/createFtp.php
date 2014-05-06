<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Ftp $model
 */

$this->title = Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Ftp',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Ftps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ftp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formFtp', [
        'model' => $model,
    ]) ?>

</div>
