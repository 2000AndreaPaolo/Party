<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;

class ClienteSearch extends Cliente{
  public function rules()
  {
    return [
      [['id'], 'safe'],
      [['id_utente'],'safe'],
    ];
  }

  public function scenarios(){
    return Model::scenarios();
  }

  public function search($params){
    $query = Cliente::find();
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);
    $this->load($params);
    if (!$this->validate()) {
      return $dataProvider;
    }
    $query->andFilterWhere(['id'=>$this->id]);
    $query->andFilterWhere(['like', 'nome', $this->nome]);
    $query->andFilterWhere(['like', 'cognome', $this->cognome]);
    $query->andFilterWhere(['like', 'codice_fiscale', $this->codice_fiscale]);
    $query->andFilterWhere(['like', 'data_nascita', $this->data_nascita]);
    $query->andFilterWhere(['id_utente'=>$this->id_utente]);
    return $dataProvider;
  }

  public function getClienteNomeByUserId($id){
    $vet = Cliente::find()->where('id_utente=:id_utente',[':id_utente'=>$id])->all();
    return $vet[0]->nome;
  }
}
