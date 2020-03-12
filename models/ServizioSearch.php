<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Servizio;

class ServizioSearch extends Servizio{
  public function rules()
  {
    return [
      [['id'], 'safe'],
      [['id_tipologia'],'safe'],
      [['id_fornitore'],'safe'],
      [['id_citta'],'safe']
    ];
  }

  public function scenarios(){
    return Model::scenarios();
  }

  public function search($params){
    $query = Servizio::find();
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);
    $this->load($params);
    if (!$this->validate()) {
      return $dataProvider;
    }
    $query->andFilterWhere(['id'=>$this->id]);
    $query->andFilterWhere(['like', 'nome', $this->nome]);
    $query->andFilterWhere(['like', 'descrizione', $this->descrizione]);
    $query->andFilterWhere(['id_tipologia'=>$this->id_tipologia]);
    $query->andFilterWhere(['id_fornitore'=>$this->id_fornitore]);
    $query->andFilterWhere(['id_citta'=>$this->id_citta]);
    return $dataProvider;
  }
  
}
