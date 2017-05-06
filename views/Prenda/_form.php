<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use yii\web\UrlManager;

use app\models\Talla;
use app\models\Tipo;

use kartik\depdrop\Depdrop;

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

    <?php
    //$tipos = \yii\helpers\ArrayHelper::map(Tipo::find()->all(),'idTipo','descripcion');
    //$tallas=  \yii\helpers\ArrayHelper::map(Talla::find()->where(['like', 'tiposPrendaId', 1])->all(),'idTalla','talla');
    ?>
    <div class="modal remote fade" id="modalvote">
            <div class="modal-dialog">
                <div class="modal-content loader-lg">
                </div>
            </div>
    </div> -->
<?php
    $form = ActiveForm::begin();
    //echo $form->field($model, 'tipoPrendaId')->dropDownList($tipos,['id' => 'talla', 'prompt'=>'Selecione una talla']);
    echo $form->field($model, 'tipoPrendaId')->dropDownList(
      ArrayHelper::map(Tipo::find()->all(), 'idTipo', 'descripcion'),
             ['prompt'=>'Selecciona tipo de prenda',
              'onchange'=>'
                $.post( "index.php?r=prenda/lists&id="+$(this).val(), function( data ) {
                  $( "select#departments-branches_branch_id" ).html( data );
                });'
            ]);
    echo $form->field($model, 'idTalla')->dropDownList(
      ArrayHelper::map(Talla::find()->all(), 'idTalla', 'talla'),
             [
               'prompt'=>'Selecciona talla',
              ]);

    echo  $form->field($model, 'dueno')->hiddenInput()->label(false);

    echo $form->field($model, 'color')->textInput(['maxlength' => true]);

    echo $form->field($model, 'descripcion')->textInput(['maxlength' => true]);

    echo $form->field($model, 'estado')->textInput(['maxlength' => true]);

    echo $form->field($model, 'imageFile')->fileInput();

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Subir' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();

    ?>
</div>


<?php
