<?php
namespace app\models;
use Yii;

class Cliente extends \yii\db\ActiveRecord{

  public static function tableName(){
    return 'cliente';
  }

  public function rules(){
    return [
      [['nome'], 'required'],
      [['cognome'],'required'],
      [['codice_fiscale'],'required'],
      [['data_nascita'],'required'],
      [['id_utente'],'required']
    ];
  }

  public function attributeLabels(){
    return [
      'id' => 'ID',
      'nome' => 'Nome',
      'codice_fiscale'=>'Codice fiscale',
      'data_nascita'=>'Data Nascita',
      'id_utente'=>'Utente',
    ];
  }
}