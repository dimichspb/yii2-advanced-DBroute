<?php

namespace backend\controllers;

use Yii;
use backend\models\Routes;
use backend\models\RoutesSearch;
use backend\models\RouteUrls;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * RoutesController implements the CRUD actions for Routes model.
 */
class RoutesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Routes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoutesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Routes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $route = $this->findModel($id);

        $RouteUrlsDataProvider = new ActiveDataProvider(['query' => $route->getRouteUrls()]);
        
        //$RouteUrlsSearchModel = new RouteUrlsSearch();
        //$RouteUrlsDataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'RouteUrlsDataProvider' => $RouteUrlsDataProvider,

        ]);
    }

    /**
     * Creates a new Routes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Routes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new RouteUrls model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateUrl($id)
    {
        $route = $this->findModel($id);

        $model = new RouteUrls();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $route->id]);
        } else {
            return $this->render('create-url', [
                'route' => $route,
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Routes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Routes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Routes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Routes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Routes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
