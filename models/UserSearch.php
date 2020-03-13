<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use app\models\Cliente;
use app\models\Fornitore;

class UserSearch extends User{
  public function rules(){
    return [
      [['id'], 'safe'],
    ];
  }

  public function scenarios(){
    return Model::scenarios();
  }

  public function search($params){
    $query = User::find();
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);
    $this->load($params);
    if (!$this->validate()) {
      return $dataProvider;
    }
    $query->andFilterWhere(['id'=>$this->id]);
    $query->andFilterWhere(['email'=>$this->email]);
    $query->andFilterWhere(['password'=>$this->password]);
    $query->andFilterWhere(['nome_immagine'=>$this->nome_immagine]);
    $query->andFilterWhere(['url_immagine'=>$this->url_immagine]);
    return $dataProvider;
  }

  public function getClienteOrFornitore($id){
    $cliente = Cliente::find()->where('id_utente=:id',[':id'=>$id])->all();
    $fornitore = Fornitore::find()->where('id_utente=:id',[':id'=>$id])->all();
    if(!empty($cliente)){
        return "cliente";
    }else{
        return "fornitore";
    }
  }
}
