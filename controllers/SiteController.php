<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Fornitore;
use app\models\Cliente;

class SiteController extends Controller{

    public function behaviors(){
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

    public function actions(){
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

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact(){
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout(){
        return $this->render('about');
    }

    public function actionRegister(){
        $model_user = new User();
        $model_fornitore = new Fornitore();
        $model_cliente = new Cliente();
        if($model_user->load(Yii::$app->request->post()) && $model_fornitore->load(Yii::$app->request->post()) && Yii::$app->request->post('form') === "fornitore"){
            if($model_user->save()){
                $model_fornitore->id_utente = $model_user->id;
                if($model_fornitore->save()){
                    Yii::$app->user->switchIdentity($model_user);
                    return $this->redirect(['/site/index']);
                }
            }
        }else if($model_user->load(Yii::$app->request->post()) && $model_cliente->load(Yii::$app->request->post()) && Yii::$app->request->post('form') === "cliente"){
            if($model_user->save()){
                $model_cliente->id_utente = $model_user->id;
                if($model_cliente->save()){
                    Yii::$app->user->switchIdentity($model_user);
                    return $this->redirect(['/site/index']);
                }
            }
        }
        return $this->render('register', [
            "model_user" => $model_user,
            "model_fornitore" => $model_fornitore,
            "model_cliente" => $model_cliente,
        ]);
    }
}
