<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

use yii\web\UrlManager;

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

// echo Html::a('<span class="glyphicon glyphicon-comment"></span>',
//                     ['/feed/mycomment','id' => $model->idPrenda],
//                     [
//                         'title' => 'View Feed Comments',
//                         'data-toggle'=>'modal',
//                         'data-target'=>'#modalvote',
//                     ]
//                    );
?>


<!-- <div class="prenda-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="modal remote fade" id="modalvote">
            <div class="modal-dialog">
                <div class="modal-content loader-lg">
                </div>
            </div>
    </div> -->
    <?php //El dueno esta oculto para enviarlo pero que no se pueda cambiar

    $tipos = \yii\helpers\ArrayHelper::map(Tipo::find()->all(),'idTipo','descripcion');
    //$tipos = ArrayHelper::map(\common\models\Category::find()->asArray()->all(), 'id', 'name');?>

    <?= $form->field($model, 'tipoPrendaId')->dropDownList(
              $tipos,
              [
                'prompt'=>'Tipo de prenda',
                'onchange'=>'
                  $.get( "'.Url::toRoute('prenda/lists').'", { id: $(this).val() } )
                          .done(function( data ) {
                              $( "idTalla#talla" ).html( data );
                          }
                      );
                  '
              ]
                  );
      //)->label('Tipo de Prenda');
      ?>
<?php
$tallas=  \yii\helpers\ArrayHelper::map(Talla::find()->where(['like', 'tiposPrendaId', $id])->all(),'idTalla','talla');

 ?>

    <?= $form->field($model, 'idTalla')->dropDownList($tallas,['id' => 'talla', 'prompt'=>'Selecione una talla']) ?>

    <?= $form->field($model, 'dueno')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();

    ?>
</div>
