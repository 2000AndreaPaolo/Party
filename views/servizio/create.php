<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
$this->title = 'Aggiunta Servizio';
$this->params['breadcrumbs'][] = ['label' => 'Servizi', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Aggiunta';
?>

<div class="altro-create">
  <?= $this->render('_form', [
    'model' => $model,
    'model_citta' => $model_citta
    ]) ?>
</div>