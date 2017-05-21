<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registrarse';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
  <div class="container mainInfo">

  <div class="site-login col-md-5 createInfoTwin">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Por favor, rellena los campos para continuar:</p>

    <?php $form = ActiveForm::begin([
      'id' => 'login-form',
      'layout' => 'horizontal',
      'fieldConfig' => [
          'template' => "{label}\n<br><br><div class=\"col-lg-offset-3 col-lg-6\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
          'labelOptions' => ['class' => 'col-lg-12 control-label, center'],
      ],
    ]); ?>
    <?= $form->field($model, 'nombreUsuario')->textInput(['maxlength' => true])->label('Nick') ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label('Contraseña') ?>

    <?= $form->field($model, 'invitaciones')->textInput(['maxlength' => true])->label('Invitación') ?>

    <div class="form-group">
      <div class="col-lg-12">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Usuario' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

        </div>
      <div class="col-md-5 col-md-offset-2 createInfoTwin">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>
    </div>
</div>
