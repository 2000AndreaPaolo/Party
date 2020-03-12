<?php
namespace app\models;
use Yii;

class Citta extends \yii\db\ActiveRecord{

  public static function tableName(){
    return 'citta';
  }

  public function rules(){
    return [
      [['via'], 'required'],
      [['comune'],'required'],
      [['cap'],'required'],
    ];
  }

  public function attributeLabels(){
    return [
      'id' => 'ID',
      'via' => 'Via',
      'comune'=>'Comune',
      'cap'=>'CAP',
    ];
  }
}
