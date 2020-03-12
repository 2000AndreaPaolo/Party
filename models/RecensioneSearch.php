<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recensione;

class RecensioneSearch extends Recensione{
  public function rules()
  {
    return [
      [['id_servizio'], 'safe'],
    ];
  }

  public function scenarios(){
    return Model::scenarios();
  }

  public function search($params){
    $query = Recensione::find();
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);
    $this->load($params);
    if (!$this->validate()) {
      return $dataProvider;
    }
    $query->andFilterWhere(['id'=>$this->id]);
    $query->andFilterWhere(['like', 'commento', $this->via]);
    $query->andFilterWhere(['like', 'valutazione', $this->comune]);
    $query->andFilterWhere(['id_servizio'=>$this->id_servizio]);
    return $dataProvider;
  }
}