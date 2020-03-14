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
    $query->andFilterWhere(['like', 'nome_immagine', $this->nome_immagine]);
    $query->andFilterWhere(['url_immagine'=>$this->url_immagine]);
    return $dataProvider;
  }
  
}
