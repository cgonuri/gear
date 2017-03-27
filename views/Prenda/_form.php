<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Talla;
use app\models\Tipo;

/* @var $this yii\web\View */
/* @var $model app\models\Prenda */
/* @var $form yii\widgets\ActiveForm
<?= $form->field($model, 'idTalla')->textInput() ?>
<?= $form->field($model, 'tipoPrendaId')->textInput() ?>
<?= $form->field($model, 'dueno')->textInput(['maxlength' => true]) ?>

*/

$model->dueno=Yii::$app->user->id;
?>

<div class="prenda-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php //El id esta oculto para enviarlo pero que no se pueda cambiar

    $tipos=  \yii\helpers\ArrayHelper::map(Tipo::find()->all(),'idTipo','descripcion'); ?>

    <?= $form->field($model, 'tipoPrendaId')->dropDownList($tipos)->label('Tipo de Prenda'); ?>

    <?= $form->field($model, 'dueno')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?php

    $tallas=  \yii\helpers\ArrayHelper::map(Talla::find()->where(['like', 'tiposPrendaId', '1'])->all(),'idTalla','talla'); ?>

    <?= $form->field($model, 'idTalla')->dropDownList($tallas)->label('Talla'); ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();

    ?>
</div>
