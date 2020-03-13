<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ClienteSearch;
$this->title = 'Info Servizio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="altro-info">
<?= Html::tag('span', "Nome: ") ?>
<?= Html::tag('span', Html::encode($model->nome)) ?>
<?= Html::tag('br') ?>
<?= Html::tag('span', "Descrizione: ") ?>
<?= Html::tag('span', Html::encode($model->descrizione)) ?>
<?= Html::tag('br') ?>
<?= Html::tag('span', "Comune: ") ?>
<?= Html::tag('span', Html::encode($model_citta->comune)) ?>
<?= Html::tag('br') ?>
<?= Html::tag('span', "Via: ") ?>
<?= Html::tag('span', Html::encode($model_citta->via)) ?>
<?= Html::tag('br') ?>
<?= Html::tag('span', "CAP: ") ?>
<?= Html::tag('span', Html::encode($model_citta->cap)) ?>
<?= Html::tag('br') ?>
<?= Html::tag('span', "Recensioni:") ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
      'valutazione:ntext',
      'commento:ntext',
      [
        'attribute' => 'Utente',
        'format'=>'raw',
        'value'=>function ($model_recensione){
            return ClienteSearch::getClienteNomeByUserId($model_recensione->id_utente);
        }
      ],
    ],
  ]); ?>
</div>