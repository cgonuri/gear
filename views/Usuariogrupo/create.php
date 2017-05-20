<?php

use yii\helpers\Html;

use app\models\Usuariogrupo;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariogrupo */

$this->title = 'Unirse a un grupo.';

?>
<div class="usuariogrupo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>
