<?php
namespace app\models;
use Yii;

class Servizio extends \yii\db\ActiveRecord{

  public static function tableName(){
    return 'servizio';
  }

  public function rules(){
    return [
      [['id'], 'required'],
      [['nome'], 'required'],
      [['descrizione'],'required'],
      [['id_tipologia'],'required'],
      [['id_fornitore'],'required'],
      [['id_citta'],'required']
    ];
  }

  public function attributeLabels(){
    return [
      'id' => 'ID',
      'nome' => 'Nome',
      'descrizione'=>'Descrizione',
      'id_tipologia'=>'Tipologia',
      'id_fornitore'=>'Fornitore',
      'id_citta'=>'Città',
    ];
  }
}
