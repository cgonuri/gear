<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prenda */

$this->title = 'Nueva Prenda';

?>
<div class="prenda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
