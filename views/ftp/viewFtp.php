<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Ftp $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Ftps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ftp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('sms', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('sms', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('sms', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'hostname',
            'username',
            'password',
            'path',
        ],
    ]) ?>

</div>
