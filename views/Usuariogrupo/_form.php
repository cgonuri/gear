<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Grupo;
use app\models\Prenda;
use app\models\Usuario;

$connection = \Yii::$app->db;
/* @var $this yii\web\View */
/* @var $model app\models\Usuariogrupo */
/* @var $form yii\widgets\ActiveForm */
$model->idUsuario = Yii::$app->user->id;
?>
<div class="usuariogrupo-form">

  <?php

    $form = ActiveForm::begin([
      'method' => 'post',
      //'action' => 'index.php?r=usuariogrupo/create',
    ]);
    $container = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'idGrupo','nombre');

    ?>
    <?= $form->field($model, 'idUsuario')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'idGrupo')->dropDownList($container)->label('Tipo de Prenda'); ?>
    <?php
    ////////////
    // echo '<pre>';
    //
    // echo 'EL MÉTODO<br>';
    //
    // print_r($container);
    //
    // $grupo = "Los guays";
    // //$modeloNuevo = $connection->createCommand("SELECT `note` FROM `glogin_users` WHERE email = '".$email."'");
    // //  'SELECT idGrupo FROM Grupo WHERE nombre = "Los molones"');
    // $consulta = $modeloNuevo->queryScalar();
    //
    // $model->idGrupo = $consulta;
    // echo $container[1]."<br>";
    // echo "QueryScalar donde el nombre es Los molones -> ".$consulta."<br>";
    // ?>
    //
    // <?php
    // $modelNew = $connection -> createCommand('SELECT idGrupo FROM Grupo');
    // $users = $modelNew->queryAll();
    ////////////////
     ?>

    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>
