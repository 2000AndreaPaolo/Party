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
    $query->andFilterWhere(['like', 'commento', $this->commento]);
    $query->andFilterWhere(['like', 'valutazione', $this->valutazione]);
    $query->andFilterWhere(['id_servizio'=>$this->id_servizio]);
    return $dataProvider;
  }

  public function getAVGById($id){
    $res = Yii::$app->db->createCommand("SELECT AVG(valutazione) FROM recensione WHERE id_servizio=:id",[':id'=>$id])->queryScalar();
    return $res;
  }
}
