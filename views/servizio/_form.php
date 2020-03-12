<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<div class="altro-form">
  <?php $form = ActiveForm::begin(); ?>
  <?=$form->field($model, 'nome')->textInput(['required'=>true,'autocomplete'=>'off']);?>
  <?= $form->field($model, 'descrizione')->textArea()?>
  <?= $form->field($model, 'id_tipologia')->dropDownList(ArrayHelper::map(\app\models\Tipologia::find()->asArray()->all(),'id','nome'),['prompt'=>'Selezionare voce...','required'=>true]) ?>
  
  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Crea' : 'Aggiorna', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php ActiveForm::end(); ?>
</div>