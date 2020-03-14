<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TipologiaSearch;
use app\models\CittaSearch;
use app\widgets\Card;
use kartik\rating\StarRating;
use app\models\RecensioneSearch;
$this->title = 'Elenco Servizi';
$this->params['breadcrumbs'][] = $this->title;
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
      echo '<div class="col-sm-3" >';
      echo Card::widget([                        
        'title' => $m->nome,                   
        'body' => $m->descrizione,   
        'footer' => '<div class="row"> <div class="col-xs-6" style="margin-right:-30px;">' . Html::a('<span class="btn btn-info">Info</span>', ['info', 'id' => $m->id]) . ' </div><div class="col-xs-6" style="margin-top: 3.5%">'. StarRating::widget([
          'name' => $m->id,
          'value' => RecensioneSearch::getAVGById($m->id),
          'pluginOptions' => [
              'readonly' => true,
              'showClear' => false,
              'showCaption' => false,
              'size' => 'xs',
          ],
      ]). '</div> </div>',
     ]);
      echo '</div>';
      $count++;
      if($count == 5)
      {
        echo '</div>';
        $count = 1;
      }
    }  
    if ($count != 5) echo '</div>';
?>
</div>