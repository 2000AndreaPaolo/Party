<?php
namespace app\models;
use Yii;

class Tipologia extends \yii\db\ActiveRecord{

  public static function tableName(){
    return 'tipologia';
  }

  public function rules(){
    return [
      [['nome'], 'required']
    ];
  }

  public function attributeLabels(){
    return [
      'id' => 'ID',
      'nome' => 'Nome'
    ];
  }
}
