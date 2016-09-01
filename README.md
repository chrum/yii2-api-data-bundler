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

* Enable the module in the config/main.php file adjusting 'class' to your needs:

~~~php

return [
    ......
        'modules' => [
            'dataBundler' => [
                'class' => 'common\modules\yii2-api-data-bundler\Module',
            ],
        ],
    ......
]

~~~

    
    
