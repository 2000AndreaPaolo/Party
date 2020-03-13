<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Profilo';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .immagine img{
        max-width: 550px;
        max-height: 550px;
    }
</style>
<div class="body-content">
    <div class="row">
        <div class="col-lg-6">
            <div class="immagine">
                <?php 
                    if($model_user->url_immagine != null){
                        echo Html::img('@web/'. $model_user->url_immagine);
                    } 
                ?>
            </div>
            <div class="media-upload">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                    <?= $form->field($model_user, 'nome_immagine')->fileInput()?>
                    <?php echo Html::hiddenInput('url_immagine', $model_user->url_immagine);?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="altro-form">
                    <?=$form->field($model_user, 'email')->input(['required'=>true, 'autocomplete'=>'off', 'email']);?>
                    <?=$form->field($model_fornitore, 'nome')->textInput(['required'=>true,'autocomplete'=>'off']);?>
                    <?=$form->field($model_fornitore, 'ragione_sociale')->textInput(['required'=>true,'autocomplete'=>'off']);?>
                    <div class="form-group">
                        <?= Html::submitButton('Conferma', ['class' => 'btn btn-primary']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>