<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Talla */

$this->title = 'Update Talla: ' . $model->idTalla;
$this->params['breadcrumbs'][] = ['label' => 'Tallas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTalla, 'url' => ['view', 'id' => $model->idTalla]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="talla-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
