<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPrenda')->textInput() ?>

    <?= $form->field($model, 'idUsuarioDa')->textInput() ?>

    <?= $form->field($model, 'idUsuarioUsa')->textInput() ?>

    <?= $form->field($model, 'fechaInicio')->textInput() ?>

    <?= $form->field($model, 'fechaFinal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
