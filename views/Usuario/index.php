<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$example = new \app\models\Usuario;

echo $example->id;
$this->title = 'Usuarios';
//$this->params['breadcrumbs'][] = $this->title;
if(isset($_GET['id'])){
  $urlId = $_GET['id'];
  if($urlId != Yii::$app->user->id)
    die();
}
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idUsuario',
            'nombre',
            'email:email',
            'password',
            'invitaciones',
            // 'puntuacion',
             'nombreUsuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
