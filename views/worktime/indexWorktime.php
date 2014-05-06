<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var istt\sms\models\WorktimeSearch $searchModel
 */

$this->title = Yii::t('sms', 'Worktimes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worktime-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_searchWorktime', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Worktime',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'start',
            'end',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
