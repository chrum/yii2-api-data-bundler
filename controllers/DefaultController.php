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
        $params = \Yii::$app->request->getQueryParams();

        $bundles = [];
        foreach($params as $name => $value) {
            if (isset($available[$name])) {
                $bundles[$name] = [
                    'timestamp' => $value
                ];
                unset($params[$name]);
            }
        }
        foreach($params as $name => $value) {
            if (strpos($name, '_')) {
                list($bundleName, $paramName) = explode('_', $name);
                if (isset($bundles[$bundleName])) {
                    $bundles[$bundleName][$paramName] = $value;
                }
            }
        }

        $result = [];
        foreach ($available as $name => $config) {
            if (isset($bundles[$name])) {
                $timestamp = $bundles[$name]['timestamp'];
                unset($bundles[$name]['timestamp']);
                $result[$name] = DataBundle::loadData($name, $config, $timestamp, $bundles[$name]);
            }
        }
        return $result;
    }
}
