<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariogrupo */

$this->title = $model->idUsuGrupo;
$this->params['breadcrumbs'][] = ['label' => 'Mis grupos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Usuariogrupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idUsuGrupo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idUsuGrupo], [
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
            'idUsuGrupo',
            'idUsuario',
            'idGrupo',

        ],
    ])
    ?>


</div>
