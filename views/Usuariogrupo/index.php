<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariogrupoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis Grupos';


?>
<div class="Usuariogrupo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Unirse a un grupo', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Crear un grupo', ['grupo/create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'idUsuGrupo',
            //'idUsuario',
            //'idGrupo',
            //'nombreGrupo',
            [
                'attribute' => 'nombreGrupo',
                'format' => 'raw',
                'value' => function ($model, $key, $index) {
                    return Html::a($model->nombreGrupo, 'index.php?r=grupo%2Fview&id=' . $model->idGrupo);
                },
            ],
            //'nombreUsuario',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
