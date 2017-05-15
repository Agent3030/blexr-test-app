<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\Log;
use app\models\search\OddsTypeSearch;
use Yii;
use app\models\Odds;
use app\models\search\OddsSearch;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;


class SiteController extends Controller
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

    public function actions()
    {

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }



    /**
     * Lists all Odds models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OddsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Odds model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Odds model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Odds();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Odds model.
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
     * Deletes an existing Odds model.
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
     * Finds the Odds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Odds the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) : array
    {
        if (($model = Odds::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionOddsFormAjax()
    {
        $response = Yii::$app->request->post();
        $model = new Log();

            try {

                if ($model->saveLog($response)) {

                    \Yii::$app->session->setFlash('alert', [
                        'body' => 'Log successfully saved',
                        'options' => ['class' => 'alert-success']
                    ]);
                    return $this->redirect('/');
                }
            } catch (\Throwable $e) {
                throw $e;
            }


        return $this->renderAjax('odds-form-ajax', compact('model'));
    }

    public function actionValidationOddsForm() : array
    {
        $response = Yii::$app->request->post();
        $model = new Log();
        if(Yii::$app->request->isAjax) {
            $model->load($response);
            \Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($model);
        } else {
            return $this->goBack();
        }

    }

    public function actionGetValuesAjax()
    {
        $response = Yii::$app->request->post();

      $model = Odds::find()->where([Odds::$oddsLabels[$response['label']]=>$response['value']])->one();

        \Yii::$app->response->format = Response::FORMAT_JSON;
        if($model){
            return [
                'log-odds_uk' => $model->odds_uk,
                'log-odds_eu' => $model->odds_eu,
                'log-odds_usa' => $model->odds_usa,
            ];
        } else {
            return false;
        }

    }

    public function actionGetAllValuesAjax()
    {
        $response = Yii::$app->request->post();
        $searchModel = new OddsTypeSearch();

        $dataProvider = $searchModel->search($response);
        $models = $dataProvider->models;
        if(!empty($models) && is_array($models)) {
            \Yii::$app->response->format = Response::FORMAT_JSON;

            return $this->getOdds($models, $response['label']);
        } else
            return false;
    }

    private function getOdds(array $models, string $oddsType)
    {
        $odds=[];
        foreach ($models as $model){
            if(Odds::$oddsLabels[$oddsType]) {
                $odds[] = $model->{Odds::$oddsLabels[$oddsType]};
            } else
                return false;
        }
        if(!empty($odds)){
            return $odds;
        } else
            return false;
    }

    public function actionContactAjax()
    {
        $response = Yii::$app->request->post();
        $model = new ContactForm();


        if ($model->load($response)) {

            if ($model->contact(Yii::$app->params['adminEmail'])) {
                \Yii::$app->session->setFlash('alert', [
                    'body' => 'Your message successfully sent!',
                    'options' => ['class' => 'alert-success']
                ]);
            } else {
                \Yii::$app->session->setFlash('alert', [
                    'body' => 'Your message didn\'t sent!',
                    'options' => ['class' => 'alert-danger']
                ]);

            }
            return $this->redirect('/');
        }
        return $this->renderAjax('_contact-ajax', compact('model'));


    }
}
