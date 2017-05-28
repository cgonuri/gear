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
*/

$model->dueno=Yii::$app->user->id;
$model->estado='Libre';
if(isset($_GET['idEstiloPrenda']))
  $idtipoPrenda = $_GET['idEstiloPrenda'] - 1;
else
  $idtipoPrenda = 6;

if(isset($_GET['idEstiloPrenda']))
  $model->tipoprendaid = $_GET['idEstiloPrenda'];
?>



    <?php
    $tipos = \yii\helpers\ArrayHelper::map(Tipo::find()->all(),'idtipo','descripcion');
    $tallas=  \yii\helpers\ArrayHelper::map(Talla::find()->where(['like', 'tiposPrendaId', $idtipoPrenda])->all(),'idTalla','talla');
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
    //echo $form->field($model, 'tipoprendaid')->dropDownList($tipos);
    echo $form->field($model, 'tipoprendaid')->dropDownList(
      ArrayHelper::map(Tipo::find()->all(), 'idtipo', 'descripcion'),
             ['prompt'=>'Selecciona tipo de prenda',
              'onchange'=>'
                $.post( "index.php?r=prenda/lists&id="+$(this).val(), function( data ) {
                  $( "select#departments-branches_branch_id" ).html( data );
                });'
            ]);
    echo $form->field($model, 'idTalla')->dropDownList($tallas, ['prompt'=>'Selecciona una talla']);
    echo $form->field($model, 'color')->dropDownList($colores,['prompt'=>'Selecciona un color']);
    echo $form->field($model, 'descripcion')->textInput(['maxlength' => true])->label('Descripción');
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
