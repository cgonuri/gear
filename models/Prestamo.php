<?php

namespace app\models;

use Yii;
//use app\models\Html;

use yii\helpers\Html;

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
            'idUsuarioDa' => 'Id Usuario Da',
            'idUsuarioUsa' => 'Id Usuario Usa',
            'fechaInicio' => 'Fecha Inicio',
            'fechaFinal' => 'Fecha Final',
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

    public function verParaCompartir($misPrendasPendientes, $misPrendasLibres, $misPrendasEsperando){
      echo '<h1>Mios que me los piden y están pendientes</h1>';

      foreach ($misPrendasPendientes as $key => $value) {
          $ruta= "../web/uploads/". $value .".jpg";
          if(file_exists($ruta)){
            $avatar=$value;
            echo '<div>';
            echo '<a href="index.php?r=prenda%2Fview&idPrenda='.$value.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'.jpg',['width' => '200px'], ['class' => 'right']).'</a>';
            echo '</div>';
          }
          else
            $avatar='blanck';
      }

      echo '<h1>Mis prendas en estado libre</h1>';
      foreach ($misPrendasLibres as $key => $value) {
          $ruta= "../web/uploads/". $value .".jpg";
          if(file_exists($ruta)){
            $avatar=$value;
            echo '<a href="index.php?r=prenda%2Fview&idPrenda='.$value.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'.jpg',['width' => '200px'], ['class' => 'right']).'</a>';
          }
          else
            $avatar='blanck';
          }
      echo '<h1>Que he pedido y están pendientes de ocupado</h1>';
      foreach ($misPrendasEsperando as $key => $value) {
        $ruta= "../web/uploads/". $value .".jpg";
        if(file_exists($ruta)){
        $avatar=$value;
        echo '<a href="index.php?r=prenda%2Fview&idPrenda='.$value.'">'.Html::img(Yii::getAlias('@web').'/uploads/'. $avatar .'.jpg',['width' => '200px'], ['class' => 'right']).'</a>';
        }
        else
          $avatar='blanck';
        }

    }
}
