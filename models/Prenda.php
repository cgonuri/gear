<?php

namespace app\models;

use Yii;

use app\models\Prestamo;
use yii\helpers\Html;
use app\models\Tipo;




/**
 * This is the model class for table "Prenda".
 *
 * @property integer $idPrenda
 * @property string $color
 * @property string $descripcion
 * @property integer $dueno
 * @property string $estado
 * @property integer $idTalla
 * @property integer $tipoprendaid
 *
 * @property Talla $idTalla0
 * @property Tipo $tipoPrenda
 * @property Usuario $dueno0
 * @property Prestamo[] $prestamos
 */
class Prenda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Prenda';
    }


    // public function attributes(){
    //     return array_merge(parent::attributes(), ['Tipo.descripcion']);
    // }

    /**
     * @inheritdoc
     */

     //use yii\base\model;

    public $imageFile;

    public function rules()
    {
        return [
            [['color', 'descripcion', 'dueno', 'estado', 'idTalla', 'tipoprendaid', 'imageFile'], 'required'],
            [['dueno', 'idTalla', 'tipoprendaid'], 'integer'],
            [['color', 'estado'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 150],
            [['idTalla'], 'exist', 'skipOnError' => true, 'targetClass' => Talla::className(), 'targetAttribute' => ['idTalla' => 'idTalla']],
            [['tipoprendaid'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['tipoprendaid' => 'idtipo']],
            //[['dueno'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['dueno' => 'idUsuario']],
            [['imageFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPrenda' => 'Id Prenda',
            'color' => 'Color',
            'descripcion' => 'Descripcion',
            'dueno' => 'Dueño',
            'estado' => 'Estado',
            'idTalla' => 'Talla',
            'tipoprendaid' => 'Tipo de Prenda',
            'file' => 'Seleccionar archivos:',
            'tipo_descripcion'=> 'Tipo Descripcion',
            'ocupadofrom'=> 'Estado',
            'descrip' => 'Tipo de prenda',
            'numTalla' => 'Talla',
            'duenoNombre' => 'Dueño',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTalla0()
    {
        return $this->hasOne(Talla::className(), ['idTalla' => 'idTalla']);
    }
    public function getIdtipo()
    {
      $container = \yii\helpers\ArrayHelper::map(Tipo::find()->all(),'idtipo','descripcion');
      return $container[$this->tipoprendaid];
    }
    public function getNumTalla(){
      $container = \yii\helpers\ArrayHelper::map(Talla::find()->all(),'idTalla','talla');

      return $container[$this->idTalla];

    }
    public function getDescrip(){
      $container = \yii\helpers\ArrayHelper::map(Tipo::find()->all(),'idtipo','descripcion');
      return $container[$this->tipoprendaid];

    }
    public function getDuenoNombre(){
      $container = \yii\helpers\ArrayHelper::map(Usuario::find()->all(),'idUsuario','nombreUsuario');
      return $container[$this->dueno];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    public function getDescripcion()
    {
        return $this->hasOne(Tipo::className(), ['idtipo' => 'descripcion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDueno()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'dueno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::className(), ['idPrenda' => 'idPrenda']);
    }
    public function upload()
    {
      $model = new Prenda();
      $ruta = "../web/uploads/". $this->idPrenda .".jpg";
      $ruta2 = "../web/uploads/". $this->idPrenda ."-1.jpg";
      if(file_exists($ruta)){
        if(file_exists($ruta2))
          $nombre=$this->idPrenda.'-2';
        else
        $nombre=$this->idPrenda.'-1';
      }
      else
        $nombre=$this->idPrenda;
      $this->imageFile->saveAs('uploads/' . $nombre . '.' . $this->imageFile->extension);
      return true;

    }

    public function uploadother()
    {
      //$model = new Prenda();
      if(isset($_GET['id']))
        $idPrenda = $_GET['id'];

      $model = Prenda::find()->where(['idPrenda' => $idPrenda])->one();

      $ruta = "../web/uploads/". $this->idPrenda .".jpg";
      $ruta2 = "../web/uploads/". $this->idPrenda ."-1.jpg";

      if(file_exists($ruta)){
        if(file_exists($ruta2))
          $nombre=$this->idPrenda.'-2';
        else
        $nombre=$this->idPrenda.'-1';
      }
      else
        $nombre=$this->idPrenda;

      $this->imageFile->saveAs('uploads/' . $nombre . '.' . $this->imageFile->extension);
    }
    public function getOcupadofrom(){
      $containerIdPrenda = \yii\helpers\ArrayHelper::map(Prestamo::find()->all(),'idPrestamo','idPrenda');
      $containerUsuarioUsa = \yii\helpers\ArrayHelper::map(Prestamo::find()->all(),'idPrestamo','idUsuarioUsa');
      $usuarios = \yii\helpers\ArrayHelper::map(Usuario::find()->all(),'idUsuario','nombreUsuario');

      //if(empty($containerIdPrenda) && empty($containerUsuarioUsa))


      if($this->estado != 'Libre'){
        $usuarioIndex = array_search($this->idPrenda, $containerIdPrenda);
        $usuarioIndex = $containerUsuarioUsa[$usuarioIndex];
        $ocupadoPor = $usuarios[$usuarioIndex];

        return $this->estado." por ".$ocupadoPor;
      }
      else{
        return $this->estado;
      }
      //return $this->hasOne(Prestamo::className(), ['fechaFinal' => 'idPrenda']);
    }
    public function getImagen(){
      return $this->idPrenda.'.jpg';
    }
    public function changeestado($idPrenda){

      $model = Prenda::find()->where(['idPrenda' => $idPrenda])->one();
      $estado = $model->estado;

      switch ($estado) {
        case 'Libre':
          $model->estado = 'Pendiente';
          break;
          case 'Pendiente':
          $model->estado = 'Ocupado';
          break;
        case 'Ocupado':
          $model->estado = 'Libre';
          break;

        default:
          break;
      }

      $model->save(false);

    }




}
