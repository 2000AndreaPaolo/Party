<?php
namespace app\controllers;
use Yii;

use app\models\LoginForm;
use app\models\User;

use yii\web\Controller;
use app\controllers\SiteController;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ProfiloController extends Controller{
    public function behaviors(){
        return [
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
            'delete' => ['POST','GET'],
            ],
        ],
        ];
    }

    public function actionIndex(){
        if(Yii::$app->user->isGuest) {
          return $this->redirect(['/site/login', 'model' => $model=new LoginForm()]);
        }
        return $this->render('index');
      }
}