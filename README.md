[Work in progress, do not use]
Api data bundling module for yii2
==========

some description, to be written...

# Requirements
- yii2

# Installation
* Update composer.json

~~~json

...

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/chrum/yii2-api-data-bundler"
        }
    ],

...

    "require-dev": {
        "chrum/yii2-api-data-bundler": "*@dev",
    },
...

~~~

* Update the project by running 'composer update'


* Add 'BundableTrait' to model which instances should be bundled and implement collectData($params = null) method
* For example:
~~~php

return [
    ......
    namespace api\models;

    use chrum\yii2\apiDataBundler\extensions\BundlableTrait;
    use common\models\ExpenseType;

    class ExpenseTypeApiModel extends ExpenseType
    {
        use BundlableTrait;

        protected static function collectData($params = null)
        {
            return ExpenseType::find()
                ->select(['id', 'title', 'parent'])
                ->where(['user_id' => null])
                ->asArray()->all();
        }
        ......
    }
    ......
]

~~~

* Enable the module in the config/main.php file adjusting 'class' to your needs:

~~~php

return [
    ......
        'modules' => [
        'apiDataBundler' => [
            'class' => 'chrum\yii2\apiDataBundler\Module',
            'bundles' => [
                'bundle_name' => [
                    'class' => 'bundle\model\class',
                    'cache' => true
                ],
                'expense_types' => [
                    'class' => 'api\models\ExpenseTypeApiModel',
                    'cache' => true
                ],
            ],

            // OPTIONAL
            'as behaviorName' => [
                'class' => 'api\extensions\AuthFilter'
            ],
        ]
        ],
    ......
]

~~~

* Bundled data is accessible with url:
http://server.address/data-bundles?{bundle name}={bundle timestamp}
Where GET params are:
    {bundle name} = {bundle timestamp}
For example:
http://server.address/data-bundles?bundle_name=0&expense_types=0

