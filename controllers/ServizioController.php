<?php
namespace app\controllers;
use Yii;
use app\models\Servizio;
use app\models\ServizioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\SiteController;
use app\models\LoginForm;
use app\models\User;

class ServizioController extends Controller{
  public function behaviors()
  {
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
    $servizioSearch = new ServizioSearch();
    $params['ServizioSearch']=array();
    $params['ServizioSearch']['id_fornitore'] = Yii::$app->user->id;
    $dataProvider = $servizioSearch->search($params);
    return $this->render('index', [
      'dataProvider' => $dataProvider,
    ]);
  }
}
