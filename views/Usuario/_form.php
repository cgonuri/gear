<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

// $this->title = 'Registrarse';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
  <div class="container mainInfo">

  <div class="site-login col-md-5 createInfoTwin">

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

    <?= $form->field($model, 'invitaciones')->passwordInput(['maxlength' => true])->label('Invitación') ?>

    <div class="form-group">
      <div class="col-lg-12">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Usuario' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

        </div>
      <div class="col-md-5 col-md-offset-2 createInfoTwin textInfo">
        <p class="">
          Únete a Armario Compartido y empieza a compartir ropa desde hoy. Crea armarios con amigos y familiares. Pide prestado... Comparte... Y ten siempre claro quién tiene tu ropa. ¡Bienvenido al mayor armario virtual! ¡Se acabó no saber qué ponerse!
          Sube tu ropa. Presta tu ropa. Disfruta compartiendo.
        </p>
        <br><br>
        <p>
          El armario compartido es una red de armarios virtuales entre particulares que hace más fácil que nunca pedir prestada la ropa a tus amigos y familiares. Sube esa ropa que te pones poco. Sácale partido a ese vestido que solo te has puesto una vez, ¡o a esos pantalones que no tienes intención de estrenar! Se trata de una iniciativa colaborativa, sostenible y muy divertida.
          Crea tu propio armario, agrega a tus conocidos y envía peticiones para usar las prendas que cuelguen en sus armarios virtuales.      </div>
        </p>      </div>
    </div>
    </div>
</div>
