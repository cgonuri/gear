<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prenda */

$this->title = 'Update Prenda: ' . $model->idPrenda;
$this->params['breadcrumbs'][] = ['label' => 'Prendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPrenda, 'url' => ['view', 'idPrenda' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoPrendaId' => $model->tipoPrendaId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prenda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
