<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var istt\sms\models\SentSearch $searchModel
 */

$this->title = Yii::t('sms', 'Sent');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_searchSent', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Sent',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'time',
//             'momt',
            'sender',
            'receiver',
//             'udhdata',
            ['attribute' => 'msgdata', 'value' => function($data, $index, $widget){ return urldecode($data->msgdata); }],
            // 'smsc_id',
            // 'service',
            // 'account',
            // 'id',
            // 'sms_type',
            // 'mclass',
            // 'mwi',
            // 'coding',
            // 'compress',
            // 'validity',
            // 'deferred',
            // 'dlr_mask',
            // 'dlr_url:url',
            // 'pid',
            // 'alt_dcs',
            // 'rpi',
            // 'charset',
            // 'boxc_id',
            // 'binfo',
            // 'meta_data:ntext',
            // 'campaign_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
