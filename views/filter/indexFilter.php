<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var istt\sms\models\FilterSearch $searchModel
 */

$this->title = Yii::t('sms', 'Filters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_searchFilter', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Filter',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'description',
            'reply_refuse',
            'reply_accept',
//             'reply_false_syntax',
            // 'ftpblack',
            // 'ftpblackfile',
            // 'ftpwhite',
            // 'ftpwhitefile',
            // 'reply_accept_dup',
            // 'reply_refuse_dup',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
