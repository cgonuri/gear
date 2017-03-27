<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Talla".
 *
 * @property integer $idTalla
 * @property integer $tiposPrendaId
 * @property integer $orden
 * @property string $talla
 *
 * @property Prenda[] $prendas
 */
class Talla extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Talla';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tiposPrendaId', 'orden'], 'integer'],
            [['talla'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTalla' => 'Id Talla',
            'tiposPrendaId' => 'Tipos Prenda ID',
            'orden' => 'Orden',
            'talla' => 'Talla',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrendas()
    {
        return $this->hasMany(Prenda::className(), ['idTalla' => 'idTalla']);
    }
}
