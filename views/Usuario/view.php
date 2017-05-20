<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap\Progress;

use app\models\Prenda;
use app\models\UsuarioGrupo;
use app\models\Prestamo;



/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->idUsuario;
//$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
//$this->params['breadcrumbs'][] = 'Mi página';
if(isset($_GET['id'])){
  $urlId = $_GET['id'];
  if($urlId != Yii::$app->user->id){
    header("Location: index.php");
    die("Acción no permitida"); //Por si fallará el header

  }
}
?>
<div class="usuario-view">

  <h1>Mi Página</h1>

    <p>
        <?= Html::a('Modificar Datos', ['update', 'id' => $model->idUsuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Mis grupos', ['/usuariogrupo', 'id' => $model->idUsuario], ['class' => 'btn btn-primary']) ?>

        <?php
        // echo Html::a('Delete', ['delete', 'id' => $model->idUsuario], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        //])
        ?>
    </p>

<?php  ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombreUsuario',
            //'idUsuario',
            'nombre',
            'email:email',
            //'password',
            //'invitaciones',
            //'puntuacion',

        ],
    ]) ?>

    <?php
//     echo Progress::widget([
//     'bars' => [
//       'percent' => 70,
//       'barOptions' => ['class' => 'progress-bar-success'],
//       'options' => ['class' => 'active progress-striped'],
//       'percent' => 30,
//       'barOptions' => ['class' => 'progress-bar-success'],
//       'options' => ['class' => 'active progress-striped']
//     ]
// ]);
// stacked bars
$subido = $grupo = $pedido = $dejado= 'progress-bar-danger';
$id = Yii::$app->user->id;

$prendas= \yii\helpers\ArrayHelper::map(Prenda::find()->all(),'idPrenda','dueno');
$grupos= \yii\helpers\ArrayHelper::map(UsuarioGrupo::find()->all(),'idUsuGrupo','idUsuario');
$pedidos= \yii\helpers\ArrayHelper::map(Prestamo::find()->all(),'idPrestamo','idUsuarioDa');
$pedidos= \yii\helpers\ArrayHelper::map(Prestamo::find()->all(),'idPrestamo','idUsuarioUsa');



if(in_array($id, $prendas))
  $subido = 'progress-bar-success';
if(in_array($id, $grupos))
  $grupo = 'progress-bar-success';
if(in_array($id, $pedidos))
  $pedido = 'progress-bar-success';
if(in_array($id, $pedidos))
  $dejado = 'progress-bar-success';

echo Progress::widget([
    'bars' => [
        ['percent' => 20, 'label' => 'Te has registrado', 'options' => ['class' => 'progress-bar-success']],
        ['percent' => 20, 'label' => 'Has subido una prenda', 'options' => ['class' => $subido]],
        ['percent' => 20, 'label' => 'Estás en un grupo', 'options' => ['class' => $grupo]],
        ['percent' => 20, 'label' => 'Has pedido una prenda', 'options' => ['class' => $pedido]],
        ['percent' => 20, 'label' => 'Has dejado una prenda', 'options' => ['class' => $dejado]],


    ]
]);

     ?>

</div>
