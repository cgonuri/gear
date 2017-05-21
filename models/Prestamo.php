<?php

namespace app\models;

use Yii;
//use app\models\Html;

use yii\helpers\Html;
use lo\modules\noty\Wrapper;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;




/**
 * This is the model class for table "Prestamo".
 *
 * @property integer $idPrestamo
 * @property integer $idPrenda
 * @property integer $idUsuarioDa
 * @property integer $idUsuarioUsa
 * @property string $fechaInicio
 * @property string $fechaFinal
 *
 * @property Prenda $idPrenda0
 * @property Usuario $idUsuarioDa0
 * @property Usuario $idUsuarioUsa0
 */
class Prestamo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Prestamo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPrenda', 'idUsuarioDa', 'idUsuarioUsa', 'fechaInicio', 'fechaFinal'], 'required'],
            [['idPrenda', 'idUsuarioDa', 'idUsuarioUsa'], 'integer'],
            [['fechaInicio', 'fechaFinal'], 'safe'],
            [['idPrenda'], 'exist', 'skipOnError' => true, 'targetClass' => Prenda::className(), 'targetAttribute' => ['idPrenda' => 'idPrenda']],
            [['idUsuarioDa'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuarioDa' => 'idUsuario']],
            [['idUsuarioUsa'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuarioUsa' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPrestamo' => 'Id Prestamo',
            'idPrenda' => 'Id Prenda',
            'idUsuarioDa' => 'Dueño de la prenda',
            'idUsuarioUsa' => 'Solicitante',
            'fechaInicio' => 'Fecha Inicio',
            'fechaFinal' => 'Fecha Final',
            'nombreUsuarioDa' => 'Dueño de la Prenda'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPrenda0()
    {
        return $this->hasOne(Prenda::className(), ['idPrenda' => 'idPrenda']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarioDa0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuarioDa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarioUsa0()
    {
      return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuarioUsa']);
    }

    public function getNombreUsuarioDa()
    {
      $container = \yii\helpers\ArrayHelper::map(Usuario::find()->all(),'idUsuario','nombreUsuario');
      return $container[$this->idUsuarioDa];
        //return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuarioUsa']);
    }

    public function getImagen(){
      return $this->idPrenda.'.jpg';
    }

    public function getEstado(){

       $container = \yii\helpers\ArrayHelper::map(Prenda::find()->all(),'idPrenda','estado');
       return $container[$this->idPrenda];
    }

    public function verParaCompartir(){

      $allPrestamosDa = ArrayHelper::map(Prestamo::find()->all(),'idPrenda', 'idUsuarioDa', 'idPrestamo');
      $allPrestamosUsa = ArrayHelper::map(Prestamo::find()->all(), 'idPrenda', 'idUsuarioUsa', 'idPrestamo');
      $allPrendasEstado = ArrayHelper::map(Prenda::find()->all(), 'idPrenda', 'estado');
      $allPrendasFecha = ArrayHelper::map(Prestamo::find()->all(),'idPrenda', 'fechaFinal');

      print_r($allPrendasFecha);

      $misPrendas = array();
      $misPrendasPendientes = array();
      $misPrendasOcupados = array();
      $misPrendasEsperando = array();
      $misPrendasUsando = array();
      $id = Yii::$app->user->id;

      foreach ($allPrestamosDa as $Dakey => $Davalue) {
        foreach ($Davalue as $idPrenda => $idUsuario) {
          if($idUsuario == $id){
            array_push($misPrendas, $idPrenda);
            if($allPrendasEstado[$idPrenda] == 'Pendiente')
              array_push($misPrendasPendientes, $idPrenda);
            if($allPrendasEstado[$idPrenda] == 'Ocupado')
              array_push($misPrendasOcupados, $idPrenda);
          }
        }
      }
      if(!empty($misPrendasPendientes)){
        Yii::$app->session->setFlash('warning', 'Tienes prendas pendientes de aceptar');
        echo Wrapper::widget([
            'layerClass' => 'lo\modules\noty\layers\Growl',
            'layerOptions'=>[
                // for every layer (by default)
                'layerId' => 'noty-layer',
                'customTitleDelimiter' => '|',
                'overrideSystemConfirm' => true,
                'showTitle' => false,
              ],
        ]);
      }

      foreach ($allPrestamosUsa as $Dakey => $Davalue) {
        foreach ($Davalue as $idPrenda => $idUsuario) {
          if($idUsuario == $id && $allPrendasEstado[$idPrenda] == 'Pendiente')
            array_push($misPrendasEsperando, $idPrenda);
          }
      }

      //Estoy usando
      foreach ($allPrestamosUsa as $idPrestamo => $idPrendaArray) {
        foreach ($idPrendaArray as $idPrenda => $idUsuarioDa) {
          if($allPrendasEstado[$idPrenda] == 'Ocupado' && $idUsuarioDa == $id)
            array_push($misPrendasUsando, $idPrenda);
        }
      }

      ?>
      <!-- <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Me han pedido</a></li>
        <li><a data-toggle="tab" href="#menu1">He prestado</a></li>
        <li><a data-toggle="tab" href="#menu2">He pedido</a></li>
        <li><a data-toggle="tab" href="#menu3">Estoy usando</a></li>

      </ul> -->
      <?php
      echo '<div class ="row">

      <div class = "container" id="home">';
      echo '<h3>Me han pedido</h3>';
      foreach ($misPrendasPendientes as $key => $value) {
          $ruta= "../web/uploads/". $value .".jpg";
          $idEncode = base64_encode($value);
          if(file_exists($ruta)){
            echo '<div class = "fotoPrestamo text-center col-xs-12 col-sm-4 col-md-3 col-lg-2">
                      <div class="marcoPrestamo">
                        <a href="index.php?r=prenda%2Fview&idPrenda='.$idEncode.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $value .'.jpg',['width' => '150px']).'</a>
                      </div>
                      <div class = "infoPrestamo text-center" >
                        <a class href=index.php?r=prestamo%2Fdelete&idPrenda='.$value.'>
                          <button class = "btn btn-success">Aceptar petición</button>
                        </a>
                        <a class href=index.php?r=prestamo%2Fliberar&idPrenda='.$value.'>
                          <button class = "btn btn-danger" >Cancelar petición</button>
                        </a>
                      </div>
                  </div>';

            }
          else
            $avatar='blanck';
      }
      echo '</div>';


      echo '<div class = "container" id="menu1">';
              echo '<h3>He prestado</h2>';
      foreach ($misPrendasOcupados as $key => $value) {
          $ruta= "../web/uploads/". $value .".jpg";
          $idEncode = base64_encode($value);
          if(file_exists($ruta)){
            echo '<div class = "fotoPrestamo text-center col-xs-12 col-sm-4 col-md-3 col-lg-2">
                      <div class="marcoPrestamo">
                        <a href="index.php?r=prenda%2Fview&idPrenda='.$idEncode.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $value .'.jpg',['width' => '150px']).'</a>
                      </div>
                      <div class = "infoPrestamo text-center" >
                        <a class href=index.php?r=prestamo%2Fdelete&idPrenda='.$value.'>
                          <button class = "btn btn-success">Devuelta</button>
                        </a>
                      </div>
                  </div>'
                  ;
            }
          else
            $avatar='blanck';

      }
      echo '</div>';

      echo '<div class = "container" id="menu2">';
      echo '<h3>He pedido</h3>';
      foreach ($misPrendasEsperando as $key => $value) {
        $ruta= "../web/uploads/". $value .".jpg";
        $idEncode = base64_encode($value);

        if(file_exists($ruta)){
          echo '<div class = "fotoPrestamo text-center col-xs-12 col-sm-4 col-md-3 col-lg-2">
                    <div class="marcoPrestamo">
                      <a href="index.php?r=prenda%2Fview&idPrenda='.$idEncode.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $value .'.jpg',['width' => '150px']).'</a>
                    </div>
                    <div class = "infoPrestamo text-center" >
                      <a class href=index.php?r=prestamo%2Fliberar&idPrenda='.$value.'>
                      <button class = "btn btn-danger" >Cancelar petición</button></a>
                    </div>
                </div>';
          }
        else
          $avatar='blanck';
      }
    echo '</div>';

    echo '<div class = "container" id="menu3">';
            echo '<h3>Estoy usando</h3>';

    foreach ($misPrendasUsando as $key => $value) {
      $ruta= "../web/uploads/". $value .".jpg";
      $idEncode = base64_encode($value);
      if(file_exists($ruta)){
        echo '<div class = "fotoPrestamo text-center  col-xs-12 col-sm-4 col-md-3 col-lg-2">
                  <div class="marcoPrestamo">
                    <a href="index.php?r=prenda%2Fview&idPrenda='.$idEncode.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $value .'.jpg',['width' => '150px']).'</a>
                  </div>
              </div>';
        }
      else
        $avatar='blanck';
    }
    echo '</div><hr>';

    echo '</div>';
    }

}
