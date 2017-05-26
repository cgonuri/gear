<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Prenda;
use app\models\Prestamo;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$model = new Prenda();
$this->title = 'Préstamos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

    </p>
<?php
// Pjax::begin();
// echo GridView::widget([
//         'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
//         'columns' => [
//             ['class' => 'yii\grid\SerialColumn'],
//
//             //'idPrestamo',
//             //'idPrenda',
//             'nombreUsuarioDa',
//             //'idUsuarioDa',
//             //'idUsuarioUsa',
//             'fechaInicio',
//             'fechaFinal',
//             'estado',
//
//             ['attribute' => 'image',
//               'format' => 'html',
//               'value' => function ($data) {
//             return Html::img(Yii::getAlias('@web').'/uploads/'. $data['imagen'],['width' => '70px']);},
//             ],
//             [
//                 'format' => 'raw',
//                 'value' => function($model) {
//                         return Html::a(
//                             '<i class=""></i>Cancelar',
//                             Url::to(['prestamo/liberar', 'id' => $model->idPrenda]),
//                             [
//                                 'id'=>'grid-custom-button',
//                                 'data-pjax'=>true,
//                                 'action'=>Url::to(['prestamo/liberar', 'id' => $model->idPrenda]),
//                                 'class'=>'button btn btn-default',
//
//                             ]
//                         );
//                 }
//             ],
//
//             ['class' => 'yii\grid\ActionColumn'],
//         ],
//     ]);

//Pjax::end();



$allPrestamosDa = ArrayHelper::map(Prestamo::find()->all(),'idPrenda', 'idUsuarioDa', 'idPrestamo');
$allPrestamosUsa = ArrayHelper::map(Prestamo::find()->all(), 'idPrenda', 'idUsuarioUsa', 'idPrestamo');
$allPrendasEstado = ArrayHelper::map(Prenda::find()->all(), 'idPrenda', 'estado');
$misPrendas = array();
$misPrendasPendientes = array();
$misPrendasOcupados = array();
$misPrendasEsperando = array();
$misPrendasUsando = array();
$id = Yii::$app->user->id;

foreach ($allPrestamosDa as $Dakey => $Davalue) {
  foreach ($Davalue as $idPrenda => $idUsuario) {
    if($idUsuario == $id){
      array_push($misPrendas, $idPrenda);
      if($allPrendasEstado[$idPrenda] == 'Pendiente')
        array_push($misPrendasPendientes, $idPrenda);
      if($allPrendasEstado[$idPrenda] == 'Ocupado')
        array_push($misPrendasOcupados, $idPrenda);
    }
  }
}

foreach ($allPrestamosUsa as $Dakey => $Davalue) {
  foreach ($Davalue as $idPrenda => $idUsuario) {
    if($idUsuario == $id && $allPrendasEstado[$idPrenda] == 'Pendiente')
      array_push($misPrendasEsperando, $idPrenda);
    }
}

//Estoy usando
foreach ($allPrestamosUsa as $idPrestamo => $idPrendaArray) {
  foreach ($idPrendaArray as $idPrenda => $idUsuarioDa) {
    if($allPrendasEstado[$idPrenda] == 'Ocupado' && $idUsuarioDa == $id)
      array_push($misPrendasUsando, $idPrenda);
  }
}

Prestamo::verParaCompartir();





?></div>
