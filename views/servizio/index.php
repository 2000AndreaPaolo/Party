<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TipologiaSearch;
$this->title = 'Elenco Servizi';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="altro-index">
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
      'id_citta:ntext',
      ['class' => 'yii\grid\ActionColumn','template' => '{update} {delete}',
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
        }
        ]],
      ],
    ]); ?>
</div>