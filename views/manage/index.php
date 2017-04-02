<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cached data bundles';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="data-bundle-index">

    <h1>
        <?= Html::encode($this->title) ?>
        <?= Html::a('Refresh all', ['refresh-all'], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Are you sure you want to refresh (delete and regenerate) all bundles?'
            ],
        ])
        ?>
    </h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'created_at:datetime',
            'params' => [
                'label' => 'Parameters',
                'format' => 'html',
                'value' => function ($model, $key, $index, $column) {
                    $html = '<ul>';
                    if ($model->params) {
                        $params = \yii\helpers\Json::decode($model->params);
                        foreach ($params as $param => $value) {
                            $html .= "<li>$param: $value</li>";
                        }
                    }
                    $html .= '<ul>';

                    return $html;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{refresh} | {delete}',
                'buttons' => [
                    'refresh' => function ($url, $model, $key) {
                        return Html::a('Refresh', ['refresh', 'id' => $model->id]);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
