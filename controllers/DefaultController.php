<?php

namespace chrum\yii2\apiDataBundler\controllers;

use yii\web\Controller;

/**
 * Default controller for the `dataBundler` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
