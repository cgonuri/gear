<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Grupo".
 *
 * @property integer $idGrupo
 * @property string $nombre
 * @property string $contrasena
 * @property string $numUsuarios
 *
 * @property UsuarioGrupo[] $usuarioGrupos
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'contrasena'], 'required'],
            [['nombre', 'contrasena', 'numUsuarios'], 'string', 'max' => 45],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idGrupo' => 'Id Grupo',
            'nombre' => 'Nombre',
            'contrasena' => 'Contrasena',
            'numUsuarios' => 'Num Usuarios',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioGrupos()
    {
        return $this->hasMany(UsuarioGrupo::className(), ['idGrupo' => 'idGrupo']);
    }
}
