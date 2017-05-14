<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->idUsuario;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Mi página';
?>
<div class="usuario-view">

  <h1>Mi Página</h1>

    <p>
        <?= Html::a('Modificar Datos', ['update', 'id' => $model->idUsuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Mis grupos', ['/usuariogrupo', 'id' => $model->idUsuario], ['class' => 'btn btn-primary']) ?>

        <?php
        // echo Html::a('Delete', ['delete', 'id' => $model->idUsuario], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        //])
        ?>
    </p>

<?php  ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombreUsuario',
            //'idUsuario',
            'nombre',
            'email:email',
            //'password',
            //'invitaciones',
            //'puntuacion',

        ],
    ]) ?>

</div>
