<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fornitore;

class FornitoreSearch extends Fornitore{
  public function rules()
  {
    return [
      [['id'], 'safe'],
    ];
  }

  public function scenarios(){
    return Model::scenarios();
  }

  public function search($params){
    $query = Fornitore::find();
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);
    $this->load($params);
    if (!$this->validate()) {
      return $dataProvider;
    }
    $query->andFilterWhere(['id'=>$this->id]);
    $query->andFilterWhere(['id_utente'=>$this->id_utente]);
    $query->andFilterWhere(['like', 'nome', $this->nome]);
    $query->andFilterWhere(['like', 'ragione_sociale', $this->ragione_sociale]);
    return $dataProvider;
  }
}
