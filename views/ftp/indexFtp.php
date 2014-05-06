<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var istt\sms\models\FtpSearch $searchModel
 */

$this->title = Yii::t('sms', 'Ftps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ftp-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_searchFtp', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sms', 'Create {modelClass}', [
  'modelClass' => 'Ftp',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'hostname',
            'username',
            // 'password',
            // 'path',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
