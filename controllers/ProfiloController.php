<?php
namespace app\controllers;
use Yii;

use app\models\LoginForm;
use app\models\User;
use app\models\Fornitore;

use yii\web\Controller;
use yii\web\UploadedFile;
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
      $model_user = User::find()->where('id=:id',[':id'=>Yii::$app->user->identity->id])->all()[0];
      $model_fornitore = Fornitore::find()->where('id_utente=:id',[':id'=>Yii::$app->user->identity->id])->all()[0];
      if($model_user->load(Yii::$app->request->post()) && $model_fornitore->load(Yii::$app->request->post())){
        $nome = UploadedFile::getInstance($model_user, 'nome_immagine');
        
        if($nome){
          $url = 'immagini/'. $nome->baseName .'.'. $nome->extension;
          $nome->saveAs($url);
          $model_user->nome_immagine = $nome;
          $model_user->url_immagine = $url;
        }
        if($model_user->save() && $model_fornitore->save()){
          return $this->redirect(['index']);
        }
      }
      return $this->render('index', [
        "model_user" => $model_user,
        "model_fornitore" => $model_fornitore
      ]);
    }
}