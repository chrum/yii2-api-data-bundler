<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cached data bundles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-bundle-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'created_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{refresh}',
                'buttons' => [
                    'refresh' => function ($url, $model, $key) {
                        return Html::a('Refresh', ['refresh', 'id' => $model->id]);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
