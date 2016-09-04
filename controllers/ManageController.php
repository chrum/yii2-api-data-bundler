<?php

namespace chrum\yii2\apiDataBundler\controllers;

use Yii;
use chrum\yii2\apiDataBundler\models\DataBundle;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManageController implements the CRUD actions for DataBundle model.
 */
class ManageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DataBundle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DataBundle::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing DataBundle model.
     * @param integer $id
     * @return mixed
     */
    public function actionRefresh($id)
    {
        $model = DataBundle::findOne($id);

        if ($model) {
            $model->refresh();
        }

        return $this->redirect(['index']);
    }
}
