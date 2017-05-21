<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Grupo;
use yii\bootstrap\Modal;
use app\models\Prestamo;
use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;

use kartik\widgets\DatePicker;




/* @var $this yii\web\View */
/* @var $model app\models\Prenda */

$this->title = $model->idPrenda;
//$this->params['breadcrumbs'][] = ['label' => 'Prendas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;


//Mandar al controlador en forma de funcion
$ruta= "../web/uploads/". $model->idPrenda .".jpg";
if(file_exists($ruta)){
  $avatar=$model->idPrenda;
}
else
  $avatar='blanck';


?>
<div class="prenda-view">
<!-- <?php
//$example = Yii::$app->tipo->;
//echo "<h1>".$example."</h1>";
 ?> -->


  <?php //if($model->imageFile !=null){
    echo '<div class="row prendaUnique"><div class="images col-md-6">';
    echo '<a href="#" class="pop">'.Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'.jpg',['width' => '300px']).'</a>';

    echo '</div><div class="info col-md-6 col-sm-12">';?>
    <div class="details">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          'duenoNombre',
          'descripcion',
            //'idPrenda',
            'color',
            //'estado',
            //'idTalla',
            'numTalla',
            //'tipoprendaid',
            'descrip',
            'ocupadofrom',
            //'estado',
        ],
    ])

    ?>
    </div>
    <?php
    echo '<div class="imagenMini col-sm-12 text-left">';
      $ruta2= "../web/uploads/". $model->idPrenda ."-1.jpg";
      if(file_exists($ruta2))
        echo '<a href="#" class="pop">'.Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'-1.jpg',['width' => '80px', 'class' => 'mini']).'</a>';
      $ruta3= "../web/uploads/". $model->idPrenda ."-2.jpg";
      if(file_exists($ruta3))
        echo '<a href="#" class="pop">'.Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'-2.jpg',['width' => '80px', 'class' => 'mini']).'</a>';
    echo '</div>';
    echo '</div></div>';
    //Ventana modal con la imagen
    echo '    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
          	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <img src="" class="imagepreview" style="width: 100%;" >
          </div>
        </div>
      </div>
    </div>';
    ?>

    <p>
      <?php
      $id = Yii::$app->user->id;

      if($model->dueno == $id){
        //echo Html::a('Subir más fotos', ['upload', 'id' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoprendaid' => $model->tipoprendaid], ['class' => 'btn btn-primary']);
        echo Html::a('Borrar Prenda', ['delete', 'idPrenda' => $model->idPrenda, 'idTalla' => $model->idTalla, 'tipoprendaid' => $model->tipoprendaid], [
              'class' => 'btn btn-danger',
              'data' => [
                  'confirm' => 'Are you sure you want to delete this item?',
                  'method' => 'post',
              ],
          ]);
          if(!file_exists($ruta3)){
            Modal::begin([
              'header' => '<h2>Selecciona una foto</h2>',
              'toggleButton' => ['label' => '<i class="glyphicon glyphicon-picture"></i> Subir otra foto',
                                  'class' => 'btn btn-success'],
            ]);
            $form = ActiveForm::begin([
              'action' => ['prenda/uploadother', 'id' => $model->idPrenda]
            ]);
            echo $form->field($model, 'imageFile')->fileInput();?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Seleccionar' : 'Subir', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', ]) ?>
            </div>

            <?php ActiveForm::end();

            Modal::end();
          }

      }else if($model->estado == 'Libre'){
        //echo Html::a('Reservar', ['prestamo/reserva', 'idPrenda' => $model->idPrenda, 'dueno' => $model->dueno], ['class' => 'btn btn-primary']);
        Modal::begin([
          'header' => '<h2>Cúando lo necesitas</h2>',
          'toggleButton' => ['label' => '<i class="glyphicon glyphicon-calendar"></i> Hacer reserva',
                              'class' => 'btn btn-success'],
        ]);
        $form = ActiveForm::begin([
          'action' => ['prestamo/reserva', 'idPrenda' => $model->idPrenda, 'dueno' => $model->dueno]
        ]);
        $prestamoModel = new Prestamo;

        echo '<label class="control-label">Selecciona fechas</label>';
        echo DatePicker::widget([
          'model' => $prestamoModel,
          'attribute' => 'fechaInicio',
          'attribute2' => 'fechaFinal',
          'options' => ['placeholder' => 'Fecha de recogida'],
          'options2' => ['placeholder' => 'Fecha de devolucion'],
          'language' => 'es',
          'separator' => 'hasta',
          'type' => DatePicker::TYPE_RANGE,
          'form' => $form,
          'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
            'startDate' => date('Y-m-d')
    ]
]);




        ?>
        <div class="form-group">
            <?= Html::submitButton($prestamoModel->isNewRecord ? 'Seleccionar' : 'Update', ['class' => $prestamoModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary', ]) ?>
        </div>

        <?php ActiveForm::end();

        Modal::end();
      }

      // if($id == 1)
      // echo Html::a('Cambiar Estado', ['changeestado', 'idPrenda' => $model->idPrenda], ['class' => 'btn btn-primary']);




?>

    </p>


</div>
