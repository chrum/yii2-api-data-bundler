<?php
/**
 * Created by PhpStorm.
 * User: chrystian
 * Date: 9/1/16
 * Time: 7:33 PM
 */

namespace chrum\yii2\apiDataBundler\extensions;


trait BundlableTrait
{
    abstract protected static function collectData($params = []);

    public function loadData($cache = true)
    {
        if (method_exists(get_called_class(), 'collectData')) {
            return self::collectData();
        }

        return null;
    }

    public function storeData()
    {

    }

    public function checkData()
    {

    }
}