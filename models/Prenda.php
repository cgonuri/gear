<?php

namespace app\models;

use Yii;

use app\models\Prestamo;


/**
 * This is the model class for table "Prenda".
 *
 * @property integer $idPrenda
 * @property string $color
 * @property string $descripcion
 * @property integer $dueno
 * @property string $estado
 * @property integer $idTalla
 * @property integer $tipoPrendaId
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
            [['color', 'descripcion', 'dueno', 'estado', 'idTalla', 'tipoPrendaId'], 'required'],
            [['dueno', 'idTalla', 'tipoPrendaId'], 'integer'],
            [['color', 'estado'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 150],
            [['idTalla'], 'exist', 'skipOnError' => true, 'targetClass' => Talla::className(), 'targetAttribute' => ['idTalla' => 'idTalla']],
            [['tipoPrendaId'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['tipoPrendaId' => 'idTipo']],
            [['dueno'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['dueno' => 'idUsuario']],
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
            'dueno' => 'Dueno',
            'estado' => 'Estado',
            'idTalla' => 'Id Talla',
            'tipoPrendaId' => 'Tipo Prenda ID',
            'file' => 'Seleccionar archivos:',
            'tipo_descripcion'=> 'Tipo Descripcion',
            'ocupadofrom'=> 'Estado',
            'descrip' => 'Tipo de prenda'

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTalla0()
    {
        return $this->hasOne(Talla::className(), ['idTalla' => 'idTalla']);
    }
    public function getDescrip(){
      $container = \yii\helpers\ArrayHelper::map(Tipo::find()->all(),'idTipo','descripcion');
      return $container[$this->tipoPrendaId];
    }
    public function getDuenoNombre(){
      $container = \yii\helpers\ArrayHelper::map(Usuario::find()->all(),'idUsuario','nombre');
      return $container[$this->dueno];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoPrendaId()
    {
        return $this->hasOne(Tipo::className(), ['descripcion' => 'tipoPrendaId']);
    }

    public function getDescripcion()
    {
        return $this->hasOne(Tipo::className(), ['idTipo' => 'descripcion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDueno0()
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
    public function getOcupadofrom(){
      $container = \yii\helpers\ArrayHelper::map(Prestamo::find()->all(),'idPrenda','fechaFinal');
      if(isset($container[$this->idPrenda])){
        return "Ocupado hasta ".$container[$this->idPrenda];
      }
      else{
        return "Libre";
      }
      //return $this->hasOne(Prestamo::className(), ['fechaFinal' => 'idPrenda']);
    }
    public function changeestado($idPrenda){

      // $prenda = new Prenda();
      // $model = $prenda->findModel($idPrenda);
      // $estado = $this->estado;
      //
      // switch ($estado) {
      //   case 'Libre':
      //     $model->estado = 'Pendiente';
      //     break;
      //   case 'Pendiente':
      //     $model->estado = 'Ocupado';
      //     break;
      //   case 'Ocupado':
      //     $model->estado = 'Libre';
      //     break;
      //
      //   default:
      //     break;
      // }
      //
      // $model->save();
      //
      // return $this->render('view', ['model' => $model]);
      //$model = new Prenda();
      // $model = $prenda->findModel($idPrenda);
      //$estado = $this->estado;
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

      $model->save();

      //return $this->render('view', ['model' => $this]);

    }




}
