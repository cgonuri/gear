<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Grupo;
use app\models\Prenda;
use app\models\Usuario;
use app\models\Usuariogrupo;


$connection = \Yii::$app->db;
/* @var $this yii\web\View */
/* @var $model app\models\Usuariogrupo */
/* @var $form yii\widgets\ActiveForm */
$model->idUsuario = Yii::$app->user->id;

//    <?= $form->field($model, 'idGrupo')->dropDownList($container)->label('Tipo de Prenda'); ?>

<div class="usuariogrupo-form">

<?php
//   echo '<pre>';
//
//   $password = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'nombre','contrasena');
//   $container = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'idGrupo','nombre');
//   $misGrupos = \yii\helpers\ArrayHelper::map(Usuariogrupo::find()->all(),'idUsuario', 'idGrupo','idUsuGrupo');
//
//   echo Yii::$app->user->id;
// foreach ($misGrupos as $key) {
//   print_r($key);
//   echo"------------<br>OTRO:";
//   # code...
// }
//
// print_r($misGrupos);
// echo($misGrupos[2][2]);
//     $form = ActiveForm::begin([
//       'method' => 'post',
//     ]);
    ?>
    <?= $form->field($model, 'idGrupo')->textInput()->label('Nombre del Grupo'); ?>
    <?php $model->idUsuario = null; ?>
    <?= $form->field($model, 'idUsuario')->PasswordInput()->label('Contraseña'); ?>

    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>
