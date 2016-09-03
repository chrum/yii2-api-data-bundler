<?php
/**
 * Created by PhpStorm.
 * User: chrystian
 * Date: 9/1/16
 * Time: 7:33 PM
 */

namespace chrum\yii2\apiDataBundler\extensions;


interface Bundlable
{
    static function collectData($params = []);
}