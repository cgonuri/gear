<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prenda */

$this->title = $model->idPrenda;
$this->params['breadcrumbs'][] = ['label' => 'Prendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$ruta= "../web/uploads/". $model->idPrenda .".jpg";
if(file_exists($ruta)){
  $avatar=$model->idPrenda;
}
else
  $avatar='blanck';


?>
<div class="prenda-view">

  <?php //if($model->imageFile !=null){
    echo Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'.jpg',
    ['width' => '200px'], ['class' => 'right']);
    $ruta2= "../web/uploads/". $model->idPrenda ."a.jpg";
    if(file_exists($ruta2))
    echo Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'a.jpg',
    ['width' => '200px'], ['class' => 'right']);
  //}
          ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idPrenda' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoPrendaId' => $model->tipoPrendaId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idPrenda' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoPrendaId' => $model->tipoPrendaId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPrenda',
            'color',
            'descripcion',
            'dueno',
            'estado',
            'idTalla',
            'tipoPrendaId',
        ],
    ]) ?>

</div>
