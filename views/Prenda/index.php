<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Prestamo;
use app\models\Usuario;
use app\models\Tipo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prendas';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prenda-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva Prenda', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}",
        'columns' => [
            //['class' => 'yii\grid\Column'],
            ['attribute' => 'image',
              'format' => 'html',
              'value' => function ($data) {
            //return Html::img(Yii::getAlias('@web').'/uploads/'. $data['imagen'],['width' => '70px'])
            $idEncode = base64_encode($data['imagen']);
            return '<a href="index.php?r=prenda%2Fview&idPrenda='.$idEncode.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $data['imagen'],['width' => '70px'], ['class' => 'right']).'</a>'
            ;},
            ],
            'descripcion',
            'descrip',
            //'idPrenda',
            //'color',
            //'dueno',
            //'estado',
            //'idTalla',
            //'tipoprendaid',
            'numTalla',
            //'imagen',
            'ocupadofrom',

            // 'tipoDescripcion',
            // 'tipo',
        //     [
        //     'attribute' => 'Tipo.descripcion',
        //     'label' => 'País',
        //     'format' => 'raw',
        //     'value' => function ($model, $key, $index, $grid) {
        //         return Html::a($model->Tipo->descripcion, '../Tipo/view?id='.$model->tipoprendaid);
        //     },
        // ],

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php
// echo '<pre>';
// $containerIdPrenda = \yii\helpers\ArrayHelper::map(Prestamo::find()->all(),'idPrestamo','idPrenda');
// $containerUsuarioUsa = \yii\helpers\ArrayHelper::map(Prestamo::find()->all(),'idPrestamo','idUsuarioUsa');
// $usuarios = \yii\helpers\ArrayHelper::map(Usuario::find()->all(),'idUsuario','nombre');
//
// print_r($containerIdPrenda);
// print_r($containerUsuarioUsa);
// print_r($usuarios);



 ?>
