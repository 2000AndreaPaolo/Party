<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
$this->title = 'Modifica Servizio: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servizi', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>

<div class="altro-update">
  <?= $this->render('_form', [
    'model' => $model,
    ]) ?>
  </div>
