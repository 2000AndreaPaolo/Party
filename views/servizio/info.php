<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ClienteSearch;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$this->title = 'Info Servizio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="altro-info">
  <div class="row">
    <div class="col-sm-6">
      <?php $form = ActiveForm::begin(); ?>
      <?=$form->field($model, 'nome')->textInput(['required'=>true,'autocomplete'=>'off']);?>
      <?= $form->field($model, 'descrizione')->textArea()?>
      <?= $form->field($model, 'id_tipologia')->dropDownList(ArrayHelper::map(\app\models\Tipologia::find()->asArray()->all(),'id','nome'),['prompt'=>'Selezionare voce...','required'=>true]) ?>
      <?=$form->field($model_citta, 'via')->textInput(['required'=>true,'autocomplete'=>'off']);?>
      <?=$form->field($model_citta, 'comune')->textInput(['required'=>true,'autocomplete'=>'off']);?>
      <?=$form->field($model_citta, 'cap')->textInput(['required'=>true,'autocomplete'=>'off','type' => 'number']);?>
  <div class="form-group">
    <?= Html::submitButton('Aggiorna', ['class' => 'btn btn-primary']) ?>
    <?= Html::submitButton('Deleta', ['class' => 'btn btn-danger', 'value' => "delete", "name" => "form"]) ?>
  </div>
  <?php ActiveForm::end(); ?>
    </div>
    <div class="col-sm-6">
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
        ]); 
      ?>
    </div>
  </div>
</div>