<?php
namespace app\models;
use Yii;

class Recensione extends \yii\db\ActiveRecord{

  public static function tableName(){
    return 'recensione';
  }

  public function rules(){
    return [
      [['commento'], 'required'],
      [['valutazione'],'required'],
      [['id_servizio'],'required'],
      [['id_utente'], 'required']
    ];
  }

  public function attributeLabels(){
    return [
      'id' => 'ID',
      'commento' => 'Commento',
      'valutazione'=>'Valutazione',
      'id_servizio'=>'Servizio',
    ];
  }
}
