<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Usuariogrupo;
use app\models\Usuario;
use app\models\Prenda;


/* @var $this yii\web\View */
/* @var $model app\models\Grupo */

$this->title = $model->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

  <?php
  $idGrupos = ArrayHelper::map(Usuariogrupo::find()->all(), 'idGrupo','idUsuario', 'idUsuGrupo');
  $nombres = ArrayHelper::map(Usuario::find()->all(), 'idUsuario','nombreUsuario');
  $usuariosEnEsteGrupo = array();


  foreach ($idGrupos as $idGrupo) {
    foreach ($idGrupo as $key => $value) {
      if($key == $model->idGrupo)
        array_push($usuariosEnEsteGrupo, $nombres[$value]);
    }
  }
  //$tallas=  \yii\helpers\ArrayHelper::map(Talla::find()->where(['like', 'tiposPrendaId', $idtipoPrenda])->all(),'idTalla','talla');

   ?>

    <table class="table table-hover">
      <thead>
      <tr>
        <th>Nombre Usuario</th>
        <th>Número de prendas subidas</th>
      </tr>
      </thead>
      <?php
      foreach ($usuariosEnEsteGrupo as $value) {
        $numPrendas = Prenda::find()
        ->where(['like', 'dueno', array_search($value, $nombres)])
        ->groupBy(['idPrenda'])
        ->count();
        echo '<tr>
              <td>'.$value.'</td>
              <td>'.$numPrendas.'</td>
              </tr>';
      }

       ?>
    </table>

</div>
