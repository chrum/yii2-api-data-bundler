<?php

namespace chrum\yii2\apiDataBundler;

/**
 * dataBundler module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'chrum\yii2\apiDataBundler\controllers';
    public $defaultRoute = 'default';

    public $bundles = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
