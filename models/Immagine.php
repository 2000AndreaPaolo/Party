<?php
namespace app\models;
use Yii;

class Immagine extends \yii\db\ActiveRecord{

  public static function tableName(){
    return 'immagine';
  }

  public function rules(){
    return [
      [['id_servizio'],'safe'],
      [['nome_immagine'],'safe'],
      [['url_immagine'],'safe'],
    ];
  }

  public function attributeLabels(){
    return [
      'id' => 'ID',
      'id_servizio' => 'Servizio',
      'nome_immagine'=>'Immagine'
    ];
  }
}
