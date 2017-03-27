<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TallaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="talla-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTalla') ?>

    <?= $form->field($model, 'tiposPrendaId') ?>

    <?= $form->field($model, 'orden') ?>

    <?= $form->field($model, 'talla') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
