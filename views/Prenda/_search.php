<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrendaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prenda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPrenda') ?>

    <?= $form->field($model, 'color') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'dueno') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'idTalla') ?>

    <?php // echo $form->field($model, 'tipoPrendaId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
