<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamo */

$this->title = $model->idPrestamo;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idPrestamo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idPrestamo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPrestamo',
            'idPrenda',
            'idUsuarioDa',
            'idUsuarioUsa',
            'fechaInicio',
            'fechaFinal',
        ],
    ]) ?>

</div>
