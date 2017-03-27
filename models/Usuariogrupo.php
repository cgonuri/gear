<?php

namespace app\models;

use Yii;

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
            [['idUsuario', 'idGrupo'], 'integer'],
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
    public function getIdGrupo0()
    {
        return $this->hasOne(Grupo::className(), ['idGrupo' => 'idGrupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
}
