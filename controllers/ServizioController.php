<?php
namespace app\controllers;
use Yii;

use app\models\Servizio;
use app\models\Citta;
use app\models\LoginForm;
use app\models\User;
use app\models\ServizioSearch;

use yii\web\Controller;
use app\controllers\SiteController;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

  public function actionUpdate($id){
    if(Yii::$app->user->isGuest) {
      return $this->redirect(['/site/login', 'model' => $model=new LoginForm()]);
    }
    $model = $this->findModel($id);
    $model_citta = Citta::find()->where('id=:id',[':id'=>$model->id_citta])->all();
    if($model->load(Yii::$app->request->post()) && $model_citta[0]->load(Yii::$app->request->post())){
      if($model->save() && $model_citta[0]->save()){
        return $this->redirect(['index', 'id' => $model->id]);
      }
    }else{
      return $this->render('update', [
        'model' => $model,
        'model_citta' => $model_citta
      ]);
    }
  }

  public function actionDelete($id){
    if(Yii::$app->user->isGuest) {
      return $this->redirect(['/site/login', 'model' => $model=new LoginForm()]);
    }
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }

  protected function findModel($id){
    if (($model = Servizio::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }
}
