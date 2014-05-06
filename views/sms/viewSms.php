<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var vendor\istt\sms\models\Sms $model
 */

$this->title = $model->receiver;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Sms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('sms', 'Update'), ['update', 'receiver' => $model->receiver, 'campaign_id' => $model->campaign_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('sms', 'Delete'), ['delete', 'receiver' => $model->receiver, 'campaign_id' => $model->campaign_id], [
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
            'momt',
            'sender',
            'receiver',
            'udhdata',
            'msgdata:ntext',
            'time',
            'smsc_id',
            'service',
            'account',
            'id',
            'sms_type',
            'mclass',
            'mwi',
            'coding',
            'compress',
            'validity',
            'deferred',
            'dlr_mask',
            'dlr_url:url',
            'pid',
            'alt_dcs',
            'rpi',
            'charset',
            'boxc_id',
            'binfo',
            'meta_data:ntext',
            'campaign_id',
        ],
    ]) ?>

</div>
