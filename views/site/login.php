<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
  <div class="container mainInfo">

  <div class="site-login col-md-5 mainInfoTwin">
    <div class="formulario">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<br><br><div class=\"col-lg-offset-3 col-lg-6\">{input}</div>\n<div class=\" col-md-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12, control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Usuario') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>

        

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    </div>

    <div class="" style="color:#999;">
        ¿Aún no tienes cuenta de usuario?<br>
        <?= Html::a('Nuevo Usuario', ['/usuario/create'], ['class'=>'btn btn-primary aun']) ?>
    </div>


        </div>
      <div class="col-md-5 col-md-offset-2 mainInfoTwin">
        <p class="">
          Únete a Armario Compartido y empieza a compartir ropa desde hoy. Crea armarios con amigos y familiares. Pide prestado... Comparte... Y ten siempre claro quién tiene tu ropa. ¡Bienvenido al mayor armario virtual! ¡Se acabó no saber qué ponerse!
          Sube tu ropa. Presta tu ropa. Disfruta compartiendo.
        </p>
        <br><br>
        <p>
          El armario compartido es una red de armarios virtuales entre particulares que hace más fácil que nunca pedir prestada la ropa a tus amigos y familiares. Sube esa ropa que te pones poco. Sácale partido a ese vestido que solo te has puesto una vez, ¡o a esos pantalones que no tienes intención de estrenar! Se trata de una iniciativa colaborativa, sostenible y muy divertida.
          Crea tu propio armario, agrega a tus conocidos y envía peticiones para usar las prendas que cuelguen en sus armarios virtuales.      </div>
        </p>
    </div>
    </div>
</div>
