<?php

use yii\helpers\Html;
use yii\grid\GridView;
use istt\sms\models\Filter;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var istt\sms\models\WhitelistSearch $searchModel
 */

$this->title = Yii::t('sms', 'Whitelists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="whitelist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_searchWhitelist', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Whitelist',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'fid', 'filter' => Filter::options(), 'value' => function($data){ return $data->filter->title; }],
            'isdn',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
