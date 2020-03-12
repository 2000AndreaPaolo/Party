<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tipologia;

class TipologiaSearch extends Tipologia{
  public function rules(){
    return [
      [['id'], 'safe'],
    ];
  }

  public function scenarios(){
    return Model::scenarios();
  }

  public function search($params){
    $query = Tipologia::find();
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);
    $this->load($params);
    if (!$this->validate()) {
      return $dataProvider;
    }
    $query->andFilterWhere(['id'=>$this->id]);
    $query->andFilterWhere(['like', 'nome', $this->nome]);
    return $dataProvider;
  }
  
  public function getTipologiaNomeById($id){
    $vet = Tipologia::find()->where('id=:id',[':id'=>$id])->all();
    return $vet[0]->nome;
  }
}
