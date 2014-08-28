<?php

namespace app\controllers;

use app\models\JsonDataProvider;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDarrowtest()
    {
        // init data provider
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => JsonDataProvider::getArrayFromJson(),
        ]);

        // set pagination
        $pagination = (new \yii\data\Pagination([
            'totalCount' => count(JsonDataProvider::getArrayFromJson()),
            'pageSize' => 10,
        ]));

        // items per page
        $perPage = Yii::$app->request->getQueryParam('per-page');

        if ($perPage) {
            $pagination->setPageSize($perPage);
        }

        //sort
        $sort = new \yii\data\Sort(['attributes' => JsonDataProvider::getSortAttributes()]);

        $dataProvider->setPagination($pagination);
        $dataProvider->setSort($sort);

        if (Yii::$app->request->getIsAjax()) {
            echo $this->renderAjax('_partialGrid', ['dataProvider' => $dataProvider]);

        } else {
        // render
        return $this->render('darrowtest', ['dataProvider' => $dataProvider]);
        }
    }
}
