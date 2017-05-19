<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use yii\web\UrlManager;

use app\models\Talla;
use app\models\Tipo;
use app\models\Prestamo;


use kartik\depdrop\Depdrop;

/* @var $this yii\web\View */
/* @var $model app\models\Prenda */
/* @var $form yii\widgets\ActiveForm
<?= $form->field($model, 'idTalla')->textInput() ?>
<?= $form->field($model, 'tipoprendaid')->textInput() ?>
<?= $form->field($model, 'dueno')->textInput(['maxlength' => true]) ?>

*/

$model->dueno=Yii::$app->user->id;
$model->estado='Libre';

// if(isset($_GET['idEstiloPrenda']))
//   $idtipoPrenda = $_GET['idEstiloPrenda'] - 1;
// else
//   $idtipoPrenda = 6;
//
// if(isset($_GET['idEstiloPrenda']))
//   $model->tipoprendaid = $_GET['idEstiloPrenda'];

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
    $tipos = \yii\helpers\ArrayHelper::map(Tipo::find()->all(),'idtipo','descripcion');
    $tallas=  \yii\helpers\ArrayHelper::map(Talla::find()->where(['like', 'tiposPrendaId', 1])->all(),'idTalla','talla');
    ?>
    <div class="modal remote fade" id="modalvote">
            <div class="modal-dialog">
                <div class="modal-content loader-lg">
                </div>
            </div>
    </div> -->
<?php

$colores = array();
array_push($colores, 'Blanco', 'Negro', 'Azul', 'Rojo', 'Morado', 'Verde',
'Rosa', 'Naranja', 'Amarillo', 'Gris', 'Plateado', 'Dorado', 'Marrón');


    $form = ActiveForm::begin();?>
    //echo $form->field($model, 'tipoprendaid')->dropDownList($tipos,['id' => 'talla', 'prompt'=>'Selecione una talla']);
    <?=  $form->field($model, 'tipoprendaid')->dropDownList($tipos
      // ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'descripcion'),
      //        ['prompt'=>'Selecciona tipo de prenda',
      //         'onchange'=>'
      //           $.post( "index.php?r=prenda/lists&id="+$(this).val(), function( data ) {
      //             $( "select#idTalla" ).html( data );
      //           });'
      //       ]
    );?>
    // echo $form->field($model, 'idTalla')->dropDownList(
    //   ArrayHelper::map(Talla::find()->all(), 'idTalla', 'talla'),
    //          [
    //            'prompt'=>'Selecciona talla',
    //           ]);
    //$dataPost=ArrayHelper::map(Talla::find()->asArray()->all(), 'idTalla', 'talla');

    <?=  $form->field($model, 'idTalla')
        ->dropDownList(
            $tallas
        );?>

  <?=  $form->field($model, 'dueno')->hiddenInput()->label(false); ?>

    <?=  $form->field($model, 'color')->dropDownList($colores,
             ['prompt'=>'Selecciona un color']); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true, 'style'=>'height:100px']); ?>
    <?=  $form->field($model, 'imageFile')->fileInput(); ?>
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Subir' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();



    ?>
</div>


<?php
