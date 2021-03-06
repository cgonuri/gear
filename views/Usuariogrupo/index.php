<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariogrupoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuariogrupos';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuariogrupo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Unirse a un grupo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'idUsuGrupo',
            'idUsuario',
            'idGrupo',
            'nombreGrupo',
            //'nombreUsuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
