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
use app\models\Tipo;

use yii\widgets\ActiveForm;


use yii\helpers\ArrayHelper;

use lo\modules\noty\Wrapper;


// echo Wrapper::widget([
//     'layerClass' => 'lo\modules\noty\layers\Growl',
// ]);
// Yii::$app->session->setFlash('error',   'mal vamos');


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


    if(isset($_GET['tipoPrendaId'])){
      $tipoPrendaId = $_GET['tipoPrendaId'];
      $model->tipoPrendaId = $tipoPrendaId;
    }
    else{
      $tipoPrendaId =$model->tipoPrendaId;
      $tipoPrendaId = null;

    }

    if(isset($_GET['idTalla'])){
      $idTalla = $_GET['idTalla'];
      $model->idTalla = $idTalla;
    }
    else{
      $idTalla = null;
    }

    if(isset($_GET['estado'])){
      $estado = $_GET['estado'];
      $model->estado = $estado;
    }
    else{
      $estado = null;
    }
    $allPrendas =  ArrayHelper::map(Prenda::find()
    ->where(['estado' => $estado])
    ->orWhere(['idTalla' => $idTalla])
    ->orWhere(['tipoPrendaId' => $tipoPrendaId])
    ->all(), 'idPrenda','dueno');

    if(!isset($_GET['tipoPrendaId'])){
      if(!isset($_GET['idTalla']))
        if(!isset($_GET['estado']))
          $allPrendas =  ArrayHelper::map(Prenda::find()->all(), 'idPrenda','dueno');
          echo 'hello';
    }



  echo '<div class= "filtro">';
  $form = ActiveForm::begin();
  echo $form->field($model, 'tipoPrendaId')->dropDownList(
    ArrayHelper::map(Tipo::find()->all(), 'idTipo', 'descripcion'),
           ['style'=>'width:300px',
             'prompt'=>'Todos',
             'onchange'=>'
              $.post( "index.php?r=prenda/filtrotipo&estado='.$estado.'&tipoPrendaId="+$(this).val(), function( data ) {
                $( "select#departments-branches_branch_id" ).html( data );
              });'
          ]);
echo '</div>';
echo '<div class= "filtro">';

          echo $form->field($model, 'idTalla')->dropDownList(
            ArrayHelper::map(Talla::find()->all(), 'idTalla', 'talla'),
                   ['style'=>'width:300px',
                     'prompt'=>'Todos',
                    'onchange'=>'
                      $.post( "index.php?r=prenda/filtrotalla&idTalla="+$(this).val(), function( data ) {
                        $( "select#departments-branches_branch_id" ).html( data );
                      });'
                  ]);

echo '</div>';
echo '<div class= "filtro">';

          echo $form->field($model, 'estado')->dropDownList(
            ArrayHelper::map(Prenda::find()->all(), 'estado', 'estado'),
                   ['style'=>'width:300px',
                     'prompt'=>'Todos',
                    'onchange'=>'
                      $.post( "index.php?r=prenda/filtroestado&estado="+$(this).val(), function( data ) {
                        $( "select#departments-branches_branch_id" ).html( data );
                      });'
                  ]);

echo '</div>';


  ActiveForm::end();



  echo '<pre>';
  $id = Yii::$app->user->id;


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




$dueno = ArrayHelper::map(Prenda::find()->all(), 'idPrenda','dueno');
$talla =  ArrayHelper::map(Prenda::find()->all(), 'idPrenda','numTalla');
$estado = ArrayHelper::map(Prenda::find()->all(), 'idPrenda','estado');




?>


<?php
echo '<div class = "row">';
echo '<div class="container">';
foreach ($allPrendas as $key => $value) {
  if(in_array($value, $compisGrupo)){
    $ruta= "../web/uploads/". $key .".jpg";
    if(file_exists($ruta)){
      echo '<div class = "fourFoto">
              <div class = "fotoBox text-center  col-sm-4 col-xs-12 col-md-3">
                <div class="marcoFoto ">
                  <a href="index.php?r=prenda%2Fview&idPrenda='.$key.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $key .'.jpg',['width' => '200px'], ['class' => 'right']).'</a>
                </div>';

                echo '<div class = "infoFoto col-md-3 '.$estado[$key].'">
                  <h3>Descripción</h3>
                  <ul>
                    <li><span>Talla: '.$talla[$key].'</span></li>
                    <li><span>Estado: '.$estado[$key].'</span></li>
                    <li><span>Dueño: '.$dueno[$key].'</span></li>';
                    if($estado[$key] == 'Libre')
                    echo '<li><a href="index.php?r=prenda%2Fview&idPrenda='.$key.'">Reservar</a></li>';

                  echo '</ul>
                </div>
              </div>
            </div>';
    }
  }
  else
    $avatar='blanck';
}
echo '</div>';
echo '</div>';




?>
