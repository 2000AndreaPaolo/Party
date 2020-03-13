<?php
namespace app\controllers;
use Yii;

use app\models\Servizio;
use app\models\Citta;
use app\models\LoginForm;
use app\models\User;
use app\models\UserSearch;
use app\models\ServizioSearch;
use app\models\Recensione;
use app\models\RecensioneSearch;

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
    if(Yii::$app->user->isGuest){
      return $this->redirect(['/site/login', 'model' => $model=new LoginForm()]);
    }
    if(UserSearch::getClienteOrFornitore(Yii::$app->user->identity->id) != 'fornitore'){
      return $this->redirect(['/site/indec', 'model' => $model=new LoginForm()]);
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
    if(UserSearch::getClienteOrFornitore(Yii::$app->user->identity->id) != 'fornitore'){
      return $this->redirect(['/site/indec', 'model' => $model=new LoginForm()]);
    }
    $model = $this->findModel($id);
    $model_citta = Citta::find()->where('id=:id',[':id'=>$model->id_citta])->all()[0];
    if($model->load(Yii::$app->request->post()) && $model_citta[0]->load(Yii::$app->request->post())){
      if($model->save() && $model_citta->save()){
        return $this->redirect(['index', 'id' => $model->id]);
      }
    }else{
      return $this->render('update', [
        'model' => $model,
        'model_citta' => $model_citta
      ]);
    }
  }
  public function actionCreate(){
    if(Yii::$app->user->isGuest) {
      return $this->redirect(['/site/login', 'model' => $model=new LoginForm()]);
    }
    if(UserSearch::getClienteOrFornitore(Yii::$app->user->identity->id) != 'fornitore'){
      return $this->redirect(['/site/indec', 'model' => $model=new LoginForm()]);
    }
    $model = new Servizio();
    $model_citta = new Citta();
    if($model->load(Yii::$app->request->post()) && $model_citta->load(Yii::$app->request->post())){
      if($model_citta->save())
      {
        $model->id_fornitore = Yii::$app->user->identity->id;
        $model->id_citta = $model_citta->id;
        if($model->save()){
          return $this->redirect(['index', 'id' => $model->id]);
        }
      }
      else  echo "ciao";exit;
      
    }else{
      return $this->render('create', [
        'model' => $model,
        'model_citta' => $model_citta
      ]);
    }
  }

  public function actionDelete($id){
    if(Yii::$app->user->isGuest) {
      return $this->redirect(['/site/login', 'model' => $model=new LoginForm()]);
    }
    if(UserSearch::getClienteOrFornitore(Yii::$app->user->identity->id) != 'fornitore'){
      return $this->redirect(['/site/indec', 'model' => $model=new LoginForm()]);
    }
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }

  public function actionInfo($id)
  {
    if(Yii::$app->user->isGuest) {
      return $this->redirect(['/site/login', 'model' => $model=new LoginForm()]);
    }
    if(UserSearch::getClienteOrFornitore(Yii::$app->user->identity->id) != 'fornitore'){
      return $this->redirect(['/site/indec', 'model' => $model=new LoginForm()]);
    }
    $model = $this->findModel($id);
    $model_citta = Citta::find()->where('id=:id',[':id'=>$model->id_citta])->all()[0];
    $RecensioneSearch = new RecensioneSearch();
    $params['RecensioneSearch']=array();
    $params['RecensioneSearch']['id_servizio'] = $id;
    $dataProvider = $RecensioneSearch->search($params);
    return $this->render('info', [
      'model' => $model,
      'model_citta' => $model_citta,
      'dataProvider' => $dataProvider
    ]);
  }
  protected function findModel($id){
    if (($model = Servizio::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }
}
