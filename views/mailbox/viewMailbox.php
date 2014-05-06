<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Mailbox $model
 */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Mailboxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailbox-view">

    <p class="pull-right">
        <?= Html::a(Yii::t('sms', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('sms', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('sms', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <h1><small><?= Yii::t('sms', 'Mailbox') ?></small> <?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'hostname',
            'email:email',
            'password',
            ['attribute' => 'option', 'value' => implode('/', $model->option)],
        ],
    ]) ?>

</div>
