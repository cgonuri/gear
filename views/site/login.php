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

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\" col-lg-12\">{input} {label}</div>\n<div class=\"col-lg-6\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    </div>

    <div class="" style="color:#999;">
        ¿Aun no tienes cuenta de usuario?<br>
        <?= Html::a('Nuevo Usuario', ['/usuario/create'], ['class'=>'btn btn-primary aun']) ?>
    </div>


        </div>
      <div class="col-md-5 col-md-offset-2 mainInfoTwin">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>
    </div>
</div>
