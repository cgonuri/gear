<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Prenda;
use app\models\Prestamo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$id = Yii::$app->user->id;
$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPrestamo',
            'idPrenda',
            'idUsuarioDa',
            'idUsuarioUsa',
            'fechaInicio',
            // 'fechaFinal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end();

$allPrestamosDa = ArrayHelper::map(Prestamo::find()->all(),'idPrenda', 'idUsuarioDa', 'idPrestamo');
$allPrestamosUsa = ArrayHelper::map(Prestamo::find()->all(), 'idPrenda', 'idUsuarioUsa', 'idPrestamo');
$allPrendasEstado = ArrayHelper::map(Prenda::find()->all(), 'idPrenda', 'estado');
$misPrendas = array();
$misPrendasPendientes = array();
$misPrendasLibres = array();
$misPrendasEsperando = array();


echo '<pre>';
echo '<br>allPrestamosDa   idPrestamo | idPrenda | idUsuarioDa';
print_r($allPrestamosDa);

echo '<br>$allPrestamosUsa idPrestamo | idPrenda | idUsuarioUsa';
print_r($allPrestamosUsa);

echo '<br>$allPrendasEstado idPrenda | estado';
print_r($allPrendasEstado);





foreach ($allPrestamosDa as $Dakey => $Davalue) {
  foreach ($Davalue as $idPrenda => $idUsuario) {
    if($idUsuario == $id){
      array_push($misPrendas, $idPrenda);
      if($allPrendasEstado[$idPrenda] == 'Pendiente')
        array_push($misPrendasPendientes, $idPrenda);
        if($allPrendasEstado[$idPrenda] == 'Libre')
          array_push($misPrendasLibres, $idPrenda);
    }
  }
}
foreach ($allPrestamosUsa as $Dakey => $Davalue) {
  foreach ($Davalue as $idPrenda => $idUsuario) {
    if($idUsuario == $id && $allPrendasEstado[$idPrenda] == 'Pendiente')
      array_push($misPrendasEsperando, $idPrenda);
    }
}



//VACIAR LOS ARRAY DESPUES DE REPRESENTARLOS!!!!
echo '<pre>';
echo '<br>Mis Prendas';
print_r($misPrendas);
echo '<br>Mis Prendas en estado Pendientes';
print_r($misPrendasPendientes);
echo '<br>Mis Prendas en estado Libres';
print_r($misPrendasLibres);
echo '<br>Mis Prendas Esperando';
print_r($misPrendasEsperando);

Prestamo::verParaCompartir($misPrendas);

?></div>
