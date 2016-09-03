<?php

namespace chrum\yii2\apiDataBundler\controllers;

use chrum\yii2\apiDataBundler\models\DataBundle;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;


/**
 * Default controller for the `dataBundler` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => [],
            ],
            'corsFilter' => [
                'class' => Cors::className(),
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $available = \Yii::$app->controller->module->bundles;
        $requested = \Yii::$app->request->getQueryParams();
        $result = [];
        foreach ($available as $name => $config) {
            if (isset($requested[$name])) {
                $result[$name] = DataBundle::loadData($name, $config, $requested[$name]);
            }
        }
        return $result;
    }
}
