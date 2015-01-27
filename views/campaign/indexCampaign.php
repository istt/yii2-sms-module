<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var istt\sms\models\CampaignSearch $searchModel
 */

$this->title = Yii::t('sms', 'Campaigns');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campaign-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_searchCampaign', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Campaign',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			'gridTitle:html',
			'gridStatus:html',
//             'title',
//             'description:ntext',
//             'created_at:datetime',
//             'updated_at:datetime',
            // 'codename',
            // 'request_date',
            // 'request_owner',
            // 'datasender',
            // 'tosubscriber:ntext',
            // 'start',
            // 'end',
            // 'status',
            // 'finished',
            // 'approved',
            // 'active',
            // 'sender',
            // 'ready',
            // 'org',
            // 'type',
            // 'throughput',
            // 'col',
            // 'isdncol',
            // 'template:ntext',
            // 'priority',
            // 'velocity',
            // 'cpworkday',
            // 'emailbox:email',
            // 'esubject',
            // 'eattachment',
            // 'ftpserver',
            // 'smsimport',
            // 'blockimport',
            // 'limit_exceeded',
            // 'send',
            // 'blocksend',
            // 'sent',
            // 'blocksent',
            // 'orderid',
            // 'exported',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
