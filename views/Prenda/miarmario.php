<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use app\models\Prenda;
use app\models\Talla;
use app\models\Grupo;
use app\models\UsuarioGrupo;
use app\models\Usuario;

use yii\helpers\ArrayHelper;

use lo\modules\noty\Wrapper;



echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Growl',
]);
Yii::$app->session->setFlash('error',   'mal vamos');


/* @var $this yii\web\View */
/* @var $searchModel app\models\PrendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mi armario';
//$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    $query = Prenda::find();


    $dataProvider = new ActiveDataProvider([
       'query' => $query,
    ]);

  $id = Yii::$app->user->id;
  echo '<pre>';
  $idMisGrupos =  ArrayHelper::map(UsuarioGrupo::find()->where(['like', 'idUsuario', $id])->all(),'idUsuGrupo','idGrupo');
  $idUsusarioIdGrupo =  ArrayHelper::map(UsuarioGrupo::find()->all(),'idGrupo','idUsuario','idUsuGrupo');;

  $compisGrupo = array();

  foreach ($idMisGrupos as $keyMisGrupos => $valueMisGrupos) {
    foreach ($idUsusarioIdGrupo as $key => $value) {
      $indice = array_keys($value);
      $indice = $indice[0];
      if($indice == $valueMisGrupos){
        $compi = $idUsusarioIdGrupo[$key][$indice];
        if($compi != $id)
          array_push($compisGrupo, $compi);
      }
    }
  }

  // $query->andFilterWhere([ 'in','dueno'=> [
  //   $compisGrupo[1]
  //   ]]);

//Pasaba que si no estás con nadie en ningún grupo, no hay filtro y puedes ver todas las prendas, por eso, si
//no estás con nadie se añade una x al filtro.
  if(empty($compisGrupo))
    array_push($compisGrupo, 'x');
  $query->andFilterWhere(['in', 'dueno', $compisGrupo]);
  if(in_array('x', $compisGrupo))
    unset($compisGrupo[0]);

  ?>

</div>

<?php


$allPrendas =  ArrayHelper::map(Prenda::find()->all(), 'idPrenda','dueno');
?>
<!DOCTYPE html>
<html>
<head>
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body>

<?php
foreach ($allPrendas as $key => $value) {
  if(in_array($value, $compisGrupo)){
    $ruta= "../web/uploads/". $key .".jpg";
    if(file_exists($ruta)){
      $avatar=$key;
      echo '<div>';
      echo '<a href="index.php?r=prenda%2Fview&idPrenda='.$key.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'.jpg',['width' => '200px'], ['class' => 'right']).'</a>';
      echo '</div>';
    }
  }
  else
    $avatar='blanck';
}
?>

</body>
</html>
