<?php

namespace chrum\yii2\apiDataBundler\models;

use chrum\yii2\apiDataBundler\extensions\Bundlable;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%data_bundles}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $data
 * @property integer $created_at
 * @property string $params
 */
class DataBundle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%data_bundles}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data', 'params'], 'string'],
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'params' => 'Parameters',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public function refresh()
    {
        $bundles = \Yii::$app->controller->module->bundles;
        if (isset($bundles[$this->name])) {
            $config = $bundles[$this->name];
            $params = $this->params ? Json::decode($this->params) : [];
            $this->data = Json::encode($config['class']::collectData($params));
            $this->created_at = time();
            $this->save();
        }
    }

    public static function loadData(string $name, array $config, $timestamp = 0, $params = [])
    {
        $result = null;
        if (isset($config['cache']) && $config['cache'] === true) {
            /* @var $dataBundle DataBundle */
            $dataBundle = self::find()
                ->where([
                    'name' => $name,
                    'params' => Json::encode($params)
                ])
                ->orderBy('created_at DESC')
                ->one();

            if ($dataBundle) {
                if ($dataBundle->created_at > $timestamp) {
                    return [
                        'data' => $dataBundle->data,
                        'timestamp' => $dataBundle->created_at
                    ];

                } else {
                    return false;
                }

            } else if (method_exists($config['class'], 'collectData')) {
                $dataBundle = new DataBundle();
                $dataBundle->name = $name;
                $dataBundle->params = Json::encode($params);
                $dataBundle->data = Json::encode($config['class']::collectData($params));
                $dataBundle->save();
                return [
                    'data' => $dataBundle->data,
                    'timestamp' => $dataBundle->created_at
                ];

            }

        } else {
            if (method_exists($config['class'], 'collectData')) {
                return [
                    'data' => Json::encode($config['class']::collectData($params)),
                    'timestamp' => 0
                ];
            }

        }

        return false;
    }
}
