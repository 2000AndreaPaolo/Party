<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Citta;

class CittaSearch extends Citta{
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
    $query = Citta::find();
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);
    $this->load($params);
    if (!$this->validate()) {
      return $dataProvider;
    }
    $query->andFilterWhere(['id'=>$this->id]);
    $query->andFilterWhere(['like', 'via', $this->via]);
    $query->andFilterWhere(['like', 'comune', $this->comune]);
    $query->andFilterWhere(['like', 'cap', $this->cap]);
    return $dataProvider;
  }
  public function getCittaComuneById($id){
    $vet = Citta::find()->where('id=:id',[':id'=>$id])->all();
    return $vet[0]->comune;
  }
}
