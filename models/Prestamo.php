<?php

namespace app\models;

use Yii;
//use app\models\Html;

use yii\helpers\Html;
use lo\modules\noty\Wrapper;


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

    public function verParaCompartir($misPrendasPendientes, $misPrendasOcupados, $misPrendasEsperando, $misPrendasUsando){

      echo '<h3>Me han pedido</h2>';
      echo '<div class = "row">
              <div class = "container pidiendo">';
      foreach ($misPrendasPendientes as $key => $value) {
          $ruta= "../web/uploads/". $value .".jpg";
          if(file_exists($ruta)){
            echo '<div class = "fourFoto">
                    <div class = "fotoPrestamo text-center col-xs-12 col-sm-4 col-md-3 col-lg-2">
                      <div class="marcoPrestamo">
                        <a href="index.php?r=prenda%2Fview&idPrenda='.$value.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $value .'.jpg',['width' => '150px']).'</a>
                      </div>
                      <div class = "infoPrestamo text-center" >
                        <a class href=index.php?r=prestamo%2Fdelete&idPrenda='.$value.'>
                          <button class = "btn btn-success">Aceptar petición</button>
                        </a>
                        <a class href=index.php?r=prestamo%2Fliberar&idPrenda='.$value.'>
                          <button class = "btn btn-danger" >Cancelar petición</button>
                        </a>
                      </div>
                    </div>
                  </div>';
            }
          else
            $avatar='blanck';

      }
      echo '</div>';
      echo '</div><hr>';

      echo '<h3>He prestado</h2>';
      echo '<div class = "row">
              <div class = "container prestado">';
      foreach ($misPrendasOcupados as $key => $value) {
          $ruta= "../web/uploads/". $value .".jpg";
          if(file_exists($ruta)){
            echo '<div class = "fourFoto">
                    <div class = "fotoPrestamo text-center col-xs-12 col-sm-4 col-md-3 col-lg-2">
                      <div class="marcoPrestamo">
                        <a href="index.php?r=prenda%2Fview&idPrenda='.$value.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $value .'.jpg',['width' => '150px']).'</a>
                      </div>
                      <div class = "infoPrestamo text-center" >
                        <a class href=index.php?r=prestamo%2Fdelete&idPrenda='.$value.'>
                          <button class = "btn btn-success">Devuelta</button>
                        </a>
                      </div>
                      </div>
                      </div>'
                  ;
            }
          else
            $avatar='blanck';

      }
      echo '</div>';
      echo '</div><hr>';


      echo '<h3>He pedido</h3>';
      echo '<div class = "row">
              <div class = "container estoyPidiendo">';
      foreach ($misPrendasEsperando as $key => $value) {
        $ruta= "../web/uploads/". $value .".jpg";
        if(file_exists($ruta)){
          echo '<div class = "fourFoto">
                  <div class = "fotoPrestamo text-center col-xs-12 col-sm-4 col-md-3 col-lg-2">
                    <div class="marcoPrestamo">
                      <a href="index.php?r=prenda%2Fview&idPrenda='.$value.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $value .'.jpg',['width' => '150px']).'</a>
                    </div>
                    <div class = "infoPrestamo text-center" >
                      <a class href=index.php?r=prestamo%2Fdelete&idPrenda='.$value.'>
                      <button class = "btn btn-danger" >Cancelar petición</button></a>
                    </div>
                  </div>
                </div>';
          }
        else
          $avatar='blanck';
      }
    echo '</div>';
    echo '</div><hr>';

    echo '<h3>Estoy usando</h3>';
    echo '<div class = "row">
            <div class = "Me han prestado">';
    foreach ($misPrendasUsando as $key => $value) {
      $ruta= "../web/uploads/". $value .".jpg";
      if(file_exists($ruta)){
        echo '<div class = "fourFoto">
                <div class = "fotoPrestamo text-center  col-xs-12 col-sm-4 col-md-3 col-lg-2">
                  <div class="marcoPrestamo">
                    <a href="index.php?r=prenda%2Fview&idPrenda='.$value.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $value .'.jpg',['width' => '150px']).'</a>
                  </div>

                </div>
              </div>';
        }
      else
        $avatar='blanck';
    }
    echo '</div>';
    echo '</div><hr>';

    //AVISO
    if(!empty($misPrendasPendientes)){
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
      Yii::$app->session->setFlash('warning', 'Tienes prendas pendientes de aceptar');
    }


    }
}
