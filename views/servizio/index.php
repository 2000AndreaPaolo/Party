<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TipologiaSearch;
use app\models\CittaSearch;
$this->title = 'Elenco Servizi';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="altro-index">
<?= Html::a('Aggiungi', ['create'], ['class' => 'btn btn-success']) ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
      'nome:ntext',
      'descrizione:ntext',
      [
        'attribute' => 'Tipologia',
        'format'=>'raw',
        'value'=>function ($model){
            return TipologiaSearch::getTipologiaNomeById($model->id_tipologia);
        }
      ],
      [
        'attribute' => 'Città',
        'format'=>'raw',
        'value'=>function ($model){
            return CittaSearch::getCittaComuneById($model->id_citta);
        }
      ],
      ['class' => 'yii\grid\ActionColumn','template' => '{update} {delete} {info}',
      'buttons' => [
        'update'=>function($url,$model){
          return Html::a('<span class="btn btn-primary">Modifica</span>', ['update', 'id' => $model->id]);
        },
        'delete' => function($url, $model){
          return Html::a('<span class="btn btn-danger">Elimina</span>', ['delete', 'id' => $model->id], [
            'class' => '',
            'data' => [
              'confirm' => 'Confermare l\'eliminazione della voce?',
              'method' => 'post',
            ],
          ]);
        }, 
        'info' =>function($url, $model){
          return Html::a('<span class="btn btn-info">Info</span>', ['info', 'id' => $model->id]);
        }
        ]],
      ],
    ]); ?>
</div>