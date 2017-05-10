<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Grupo;


/* @var $this yii\web\View */
/* @var $model app\models\Prenda */

$this->title = $model->idPrenda;
$this->params['breadcrumbs'][] = ['label' => 'Prendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//Mandar al controlador en forma de funcion
$ruta= "../web/uploads/". $model->idPrenda .".jpg";
if(file_exists($ruta)){
  $avatar=$model->idPrenda;
}
else
  $avatar='blanck';


?>
<div class="prenda-view">
<!-- <?php
//$example = Yii::$app->tipo->;
//echo "<h1>".$example."</h1>";
 ?> -->


  <?php //if($model->imageFile !=null){
    echo Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'.jpg',['width' => '200px'], ['class' => 'right']);

    $ruta2= "../web/uploads/". $model->idPrenda ."-1.jpg";
    if(file_exists($ruta2))
      echo Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'-1.jpg',['width' => '200px'], ['class' => 'right']);

    $ruta3= "../web/uploads/". $model->idPrenda ."-2.jpg";
    if(file_exists($ruta3))
      echo Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'-2.jpg',
      ['width' => '200px'], ['class' => 'right']);
  //}
          ?>

    <p>
      <?php
      $id = Yii::$app->user->id;

      if($model->dueno == $id){
        echo Html::a('Cambiar o subir más fotos', ['update', 'idPrenda' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoPrendaId' => $model->tipoPrendaId], ['class' => 'btn btn-primary']);
        echo Html::a('Borrar Prenda', ['delete', 'idPrenda' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoPrendaId' => $model->tipoPrendaId], [
              'class' => 'btn btn-danger',
              'data' => [
                  'confirm' => 'Are you sure you want to delete this item?',
                  'method' => 'post',
              ],
          ]);
          if($model->estado == 'Pendiente')
            echo Html::a('Dejar prenda', ['changeestado', 'idPrenda' => $model->idPrenda], ['class' => 'btn btn-primary']);

      }else if($model->estado == 'Libre'){
        echo Html::a('Reservar', ['prestamo/reserva', 'idPrenda' => $model->idPrenda, 'dueno' => $model->dueno], ['class' => 'btn btn-primary']);
      }

      if($id == 1)
      echo Html::a('Cambiar Estado', ['changeestado', 'idPrenda' => $model->idPrenda], ['class' => 'btn btn-primary']);




        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idPrenda',
            'color',
            'descripcion',
            'duenoNombre',
            //'estado',
            //'idTalla',
            //'tipoPrendaId',
            'descrip',
            'ocupadofrom',
            'estado',
        ],
    ])


    ?>


</div>
