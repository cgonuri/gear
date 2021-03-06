<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Tipo".
 *
 * @property integer $idTipo
 * @property string $descripcion
 *
 * @property Prenda[] $prendas
 */
class Tipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipo' => 'Id Tipo',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrendas()
    {
        return $this->hasMany(Prenda::className(), ['tipoPrendaId' => 'idTipo']);
    }

    
}
