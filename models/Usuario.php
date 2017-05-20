<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Usuario".
 *
 * @property integer $idUsuario
 * @property string $nombre
 * @property string $email
 * @property string $password
 * @property integer $invitaciones
 * @property integer $puntuacion
 * @property string $nombreUsuario
 *
 * @property Prenda[] $prendas
 * @property Prestamo[] $prestamos
 * @property Prestamo[] $prestamos0
 * @property UsuarioGrupo[] $usuarioGrupos
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
public static function findByUsername($username) {
  return static::findOne(['nombreUsuario' => $username]);
}

public static function findIdentity($id) {
   return static::findOne($id);
}

public function getId() {
  return $this->idUsuario;
}

public function getAuthKey() { }

public function validateAuthKey($authKey) { }

// Comprueba que el password que se le pasa es correcto
public function validatePassword($password) {
     return $this->password === ($password); // Si se utiliza otra función de encriptación distinta a md5, habrá que cambiar esta línea
}
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          // ['stdo_allowed', 'default', 'value' => 1],
            [['nombre', 'email', 'password', 'nombreUsuario'], 'required'],
            [['invitaciones'], 'default', 'value' => 5],
            [['puntuacion'], 'default', 'value' => 5],
            [['nombre', 'email', 'password', 'nombreUsuario'], 'string', 'max' => 45],
            [['nombreUsuario', 'email'], 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'email' => 'Email',
            'password' => 'Password',
            'invitaciones' => 'Invitaciones',
            'puntuacion' => 'Puntuacion',
            'nombreUsuario' => 'Nombre de Usuario (Nick)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrendas()
    {
        return $this->hasMany(Prenda::className(), ['dueno' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::className(), ['idUsuarioDa' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos0()
    {
        return $this->hasMany(Prestamo::className(), ['idUsuarioUsa' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioGrupos()
    {
        return $this->hasMany(UsuarioGrupo::className(), ['idUsuario' => 'idUsuario']);
    }
}
