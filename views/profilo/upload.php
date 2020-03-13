<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
?>

<div class="media-upload">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model_user, 'nome_immagine')->fileInput()?>
    <div class="form-group">
        <?= Html::submitButton('Registrati', ['class' => 'btn btn-success', 'value' => "fornitore", "name" => "form"]) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>