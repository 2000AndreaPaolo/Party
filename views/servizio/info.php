<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ClienteSearch;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\rating\StarRating;
use app\models\RecensioneSearch;
$this->title = 'Info Servizio';
$this->params['breadcrumbs'][] = ['label' => 'Servizi', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<style>
  .immagine img{
      max-width: 350px;
      max-height: 350px;
  }
</style>
<div class="altro-info">
  <div class="row">
    <div class="col-sm-4">
      <div class="immagine">
        <?php 
            if($model->url_immagine != null){
                echo Html::img('@web/'. $model->url_immagine);
            } 
        ?>
      </div>
      <div class="media-upload">
          <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
          <?= $form->field($model, 'nome_immagine')->fileInput()?>
          <?php echo Html::hiddenInput('url_immagine', $model->url_immagine);?>
      </div>
    </div>
    <div class="col-sm-4">
      <?=$form->field($model, 'nome')->textInput(['required'=>true,'autocomplete'=>'off']);?>
      <?= $form->field($model, 'descrizione')->textArea()?>
      <?= $form->field($model, 'id_tipologia')->dropDownList(ArrayHelper::map(\app\models\Tipologia::find()->asArray()->all(),'id','nome'),['prompt'=>'Selezionare voce...','required'=>true]) ?>
      <?=$form->field($model_citta, 'via')->textInput(['required'=>true,'autocomplete'=>'off']);?>
      <?=$form->field($model_citta, 'comune')->textInput(['required'=>true,'autocomplete'=>'off']);?>
      <?=$form->field($model_citta, 'cap')->textInput(['required'=>true,'autocomplete'=>'off','type' => 'number']);?>
  <div class="form-group">
    <?= Html::submitButton('Aggiorna', ['class' => 'btn btn-primary']) ?>
    <?= Html::submitButton('Elimina', ['class' => 'btn btn-danger', 'value' => "delete", "name" => "form"]) ?>
  </div>
  <?php ActiveForm::end(); ?>
    </div>
    <div class="col-sm-4">
      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'columns' => [
            [
              'attribute' => 'Valutazione',
              'format'=>'raw',
              'value'=>function ($model_recensione){
                  return StarRating::widget([
                    'name' => $model_recensione->id,
                    'value' => $model_recensione->valutazione,
                    'pluginOptions' => [
                        'readonly' => true,
                        'showClear' => false,
                        'showCaption' => false,
                        'size' => 'xs',
                    ],
                ]);
              }
            ],
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