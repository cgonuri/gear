<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Grupo;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GrupoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Grupo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php

// $realPass = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'nombre','contrasena', 'idGrupo');
//  //echo "<br>Resul = ".$realPass['Los Chachis'];
// echo  '<pre>';
// print_r ($realPass);
// if($realPass == $contrasena){
//
// }
// $model = new Grupo();
// $indice = "1";
// $nombre = "000";
// $contrasena = "000";
//'indice' => $indice, 'nombre' => $nombre, 'contrasena' => $contrasena

 ?>
<!-- <form class="" action="index.php?r=grupo/" method="post">


<input type="text" name="nombre" value="">
<input type="text" name="contrasena" value="">
<input type="text" name="indice" value=""> -->

<?= Html::a('Ingresar','index.php?r=Usuariogrupo/update', ['class' => 'btn btn-primary']) ?></form>
</div>
