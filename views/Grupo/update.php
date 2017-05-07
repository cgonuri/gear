
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$nombre = $_GET['nombre'];
$indice = $_GET['indice'];
$contrasena = $_GET['contrasena'];

?>

<?php $form = ActiveForm::begin(); ?>
<?= Html::a('Ingresar',['ingresar','indice' => $indice, 'nombre' => $nombre, 'contrasena' => $contrasena] ,['class' => 'btn btn-primary']) ?>
<?php

//namespace app\models;

use yii\base\Model;

class IngresoFormulario extends Model
{
    public $nombre;
    public $correo;

    public function rules()
    {
        return [
            [['nombre', 'correo'], 'required'],
            ['correo', 'email'],
        ];
    }
}


 ?>

 <?php
 //public function actionIngreso()
{
 $model = new IngresoFormulario;

  if ($model->load(Yii::$app->request->post()) && $model->validate()) {
  // Valida los datos recibidos en $model

   // Se puede manipular los datos de $model

   return $this->render('confirmar-ingreso', ['model' => $model]);
 } else {
  // Se despliega la pagina inicial o si hay un error de validacion
  return $this->render('ingreso', ['model' => $model]);
 }
}
?>

///////////////////////// (FORMULARIO)
<?php

// use yii\helpers\Html;
// use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'correo') ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>


/////////////////////////// VISTA

<?php
//use yii\helpers\Html;
?>
<p>Usted ha ingresado la siguiente informacion:</p>

<ul>
    <li><label>Nombre</label>: <?= Html::encode($model->nombre) ?></li>
    <li><label>Correo</label>: <?= Html::encode($model->correo) ?></li>
</ul>


 ?>
