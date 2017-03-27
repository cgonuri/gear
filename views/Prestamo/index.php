<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Prestamo', ['create'], ['class' => 'btn btn-success']) ?>
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
<?php Pjax::end(); ?></div>
