<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/coat.ico" type="image/x-icon" />
    <script src="js/javaScript.js"></script>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Armario Compartido',
        //'brandUrl' => Yii::$app->homeUrl,
        'brandUrl' =>  Url::to(['prenda/miarmario', 'id' => Yii::$app->user->id]),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    if(Yii::$app->user->isGuest)
  		$items = [['label' => 'Acceder / Registrarse', 'url' => ['/site/login']]];
  	else {
      $itemsac=require 'menu.php';
  		$items[]='<li>'
                  . Html::beginForm(['/site/logout'], 'post')
                  . Html::submitButton(
                      'Salir ( ' . Yii::$app->user->identity->nombreUsuario . ' )',
                      ['class' => 'btn btn-link logout']
                  )
                  . Html::endForm()
                  . '</li>';
  	}
  	if(isset($itemsac))
  		echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-left'],
          'items' =>$itemsac
      ]);

      echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-right'],
          'items' =>$items
      ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Creado por Carlos Gonzalez 2017</p>
        <p class="pull-right">Contacto: carlongonuri@gmail.com</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
