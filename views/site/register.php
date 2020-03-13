<style>
    .testo h2{
        text-align: center;
    }
</style>
<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
?>
<div class="body-content">
    <div class="row">
        <div class="col-lg-6 testo">
            <h2>Registrazione di un cliente</h2>
            <div class="altro-form">
                <?php $form = ActiveForm::begin(); ?>
                <?=$form->field($model_user, 'email')->input(['required'=>true, 'autocomplete'=>'off', 'email']);?>
                <?=$form->field($model_user, 'password')->passwordInput(['required'=>true, 'autocomplete'=>'off']);?>
                <?=$form->field($model_cliente, 'nome')->textInput(['required'=>true,'autocomplete'=>'off']);?>
                <?=$form->field($model_cliente, 'cognome')->textInput(['required'=>true,'autocomplete'=>'off']);?>
                <?=$form->field($model_cliente, 'codice_fiscale')->textInput(['required'=>true,'autocomplete'=>'off']);?>
                <?=$form->field($model_cliente, 'data_nascita')->textInput(['type'=>'date', 'required'=>true, 'autocomplete'=>'off']);?>
                <div class="form-group">
                    <?= Html::submitButton('Registrati', ['class' => 'btn btn-success', 'value' => "cliente", "name" => "form"]) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="col-lg-6 testo">
            <h2>Registrazione di un fornitore</h2>
            <div class="altro-form">
                <?php $form = ActiveForm::begin(); ?>
                <?=$form->field($model_user, 'email')->input(['required'=>true, 'autocomplete'=>'off', 'email']);?>
                <?=$form->field($model_user, 'password')->passwordInput(['required'=>true, 'autocomplete'=>'off']);?>
                <?=$form->field($model_fornitore, 'nome')->textInput(['required'=>true,'autocomplete'=>'off']);?>
                <?=$form->field($model_fornitore, 'ragione_sociale')->textInput(['required'=>true,'autocomplete'=>'off']);?>
                <div class="form-group">
                    <?= Html::submitButton('Registrati', ['class' => 'btn btn-success', 'value' => "fornitore", "name" => "form"]) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>