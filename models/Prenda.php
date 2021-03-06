<?php

namespace app\models;

use Yii;

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
      return $container[$this->tipoPrendaId];
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
      $ruta= "../web/uploads/". $this->idPrenda .".jpg";

      if(file_exists($ruta))
        $nombre=$this->idPrenda.'a';
      else
        $nombre=$this->idPrenda;


      $this->imageFile->saveAs('uploads/' . $nombre . '.' . $this->imageFile->extension);
      return true;

    }

}
