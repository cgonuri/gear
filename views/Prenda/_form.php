<?php
//SEMANA 1 FINDE!!!! NO FUNCIONAAAA
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
*/

$model->dueno=Yii::$app->user->id;
$model->estado='Libre';
if(isset($_GET['idEstiloPrenda']))
  $idTIPOPrenda = $_GET['idEstiloPrenda'] - 1;
else
  $idTIPOPrenda = 6;

if(isset($_GET['idEstiloPrenda']))
  $model->tipoPrendaId = $_GET['idEstiloPrenda'];


?>



    <?php
    $tipos = \yii\helpers\ArrayHelper::map(Tipo::find()->all(),'idTipo','descripcion');
    $tallas=  \yii\helpers\ArrayHelper::map(Talla::find()->where(['like', 'tiposPrendaId', $idTIPOPrenda])->all(),'idTalla','talla');
    ?>
    <div class="modal remote fade" id="modalvote">
            <div class="modal-dialog">
                <div class="modal-content loader-lg">
                </div>
            </div>
    </div>
<?php
$colores = array();
$colores=['Blanco', 'Negro', 'Azul', 'Rojo', 'Morado', 'Verde',
'Rosa', 'Naranja', 'Amarillo', 'Gris', 'Plateado', 'Dorado', 'Marrón'];
$colores = array_combine($colores, $colores);


    $form = ActiveForm::begin();
    //echo $form->field($model, 'tipoPrendaId')->dropDownList($tipos);
    echo $form->field($model, 'tipoPrendaId')->dropDownList(
      ArrayHelper::map(Tipo::find()->all(), 'idTipo', 'descripcion'),
             ['prompt'=>'Selecciona tipo de prenda',
              'onchange'=>'
                $.post( "index.php?r=prenda/lists&id="+$(this).val(), function( data ) {
                  $( "select#departments-branches_branch_id" ).html( data );
                });'
            ]);
    echo $form->field($model, 'idTalla')->dropDownList($tallas, ['prompt'=>'Selecciona una talla']);
    echo $form->field($model, 'color')->dropDownList($colores,['prompt'=>'Selecciona un color']);
    echo $form->field($model, 'descripcion')->textInput(['maxlength' => true, 'style'=>'height:100px']);
    echo $form->field($model, 'imageFile')->fileInput();

    echo  $form->field($model, 'dueno')->hiddenInput()->label(false);
    echo  $form->field($model, 'estado')->hiddenInput()->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Subir' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();
    ?>
</div>


<?php
