<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var istt\sms\models\Campaign $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sms', 'Campaigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campaign-view">

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
            'createtime:datetime',
            'updatetime:datetime',
            'codename',
            'request_date',
            'request_owner',
            'datasender',
            'tosubscriber:ntext',
            'start',
            'end',
            'status',
            'finished',
            'approved',
            'active',
            'sender',
            'ready',
            'org',
            'type',
            'throughput',
            'col',
            'isdncol',
            'template:ntext',
            'priority',
            'velocity',
            'cpworkday',
            'emailbox:email',
            'esubject',
            'eattachment',
            'ftpserver',
            'smsimport',
            'blockimport',
            'limit_exceeded',
            'send',
            'blocksend',
            'sent',
            'blocksent',
            'orderid',
            'exported',
        ],
    ]) ?>

</div>


<?php $cpfilters = new ActiveDataProvider([
		'query' => $model->getCpfilter()
])?>
<?= GridView::widget([ 'dataProvider' => $cpfilters ])?>