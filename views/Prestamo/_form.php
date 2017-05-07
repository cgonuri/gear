<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPrenda')->textInput() ?>

    <?= $form->field($model, 'idUsuarioDa')->textInput() ?>

    <?= $form->field($model, 'idUsuarioUsa')->textInput() ?>

    <?= $form->field($model, 'fechaInicio')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'ES',
    'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'fechaFinal')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'ES',
    'dateFormat' => 'yyyy-MM-dd',
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();
    echo Html::a('Cambiar Estado', ['prenda/changeestado', 'idPrenda' => $model->idPrenda], ['class' => 'btn btn-primary']);

    ?>

</div>
