<?php

namespace app\models;

use Yii;
use yii\helpers\Html;


/**
 * This is the model class for table "Usuariogrupo".
 *
 * @property integer $idUsuGrupo
 * @property integer $idUsuario
 * @property integer $idGrupo
 *
 * @property Grupo $idGrupo0
 * @property Usuario $idUsuario0
 */
class Usuariogrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Usuariogrupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUsuario', 'idGrupo'], 'required'],
            [['idGrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['idGrupo' => 'idGrupo']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUsuGrupo' => 'Id Usu Grupo',
            'idUsuario' => 'Id Usuario',
            'idGrupo' => 'Id Grupo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGrupo()
    {
        return $this->hasOne(Grupo::className(), ['idGrupo' => 'idGrupo']);
        //  $container = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'idGrupo','nombre');
        //  return $container[$this->idGrupo];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0(){
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
    public function getNombreGrupo(){
       $container = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'idGrupo', 'nombre');
       return $container[$this->idGrupo];
    }
    public function getNombreUsuario(){
      $container = \yii\helpers\ArrayHelper::map(Usuario::find()->all(),'idUsuario','nombre');
      return $container[$this->idGrupo];
    }
    public function getGrupoPassword($nombre){
      $container = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'nombre','contrasena');
      //return $container[$this->NombreGrupo];
      return $container[$nombre];
    }
    public function getPasswordGrupo(){
       $container = \yii\helpers\ArrayHelper::map(Grupo::find()->all(),'idGrupo', 'contrasena');
       return $container[$this->idGrupo];
    }



}
