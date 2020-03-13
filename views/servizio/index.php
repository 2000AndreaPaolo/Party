<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TipologiaSearch;
use app\models\CittaSearch;
use app\widgets\Card;
$this->title = 'Elenco Servizi';
$this->params['breadcrumbs'][] = $this->title;
//print_r($model[1]->nome);
?>

<div class="altro-index">
<?= Html::a('Aggiungi', ['create'], ['class' => 'btn btn-success', 'style' => 'margin-bottom: 20px']) ?>
<?php 
    $count = 1;
    foreach($model as $m)   
    {         
      if($count == 1)
      {
        echo '<div class="row">';
      }        
      echo '<div class="col-sm-3">';
      echo Card::widget([                        
        'title' => $m->nome,                   
        'body' => $m->descrizione,   
        'footer' =>  Html::a('<span class="btn btn-info">Info</span>', ['info', 'id' => $m->id])
     ]);
      echo '</div>';
      $count++;
      if($count == 4)
      {
        echo '</div>';
        $count = 1;
      }
    }  
    if ($count != 4) echo '</div>';
?>

</div>