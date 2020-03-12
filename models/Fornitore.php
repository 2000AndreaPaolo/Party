<?php
namespace app\models;
use Yii;

class Fornitore extends \yii\db\ActiveRecord{

  public static function tableName(){
    return 'fornitore';
  }

  public function rules(){
    return [
      [['id_utente'], 'required'],
      [['nome'],'required'],
      [['ragione_sociale'],'required'],
    ];
  }

  public function attributeLabels(){
    return [
      'id' => 'ID',
      'nome'=>'Nome',
      'ragione_sociale'=>'Ragione sociale',
    ];
  }
}
