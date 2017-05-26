<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prestamo;
use app\models\Prenda;


/**
 * PrestamoSearch represents the model behind the search form about `app\models\Prestamo`.
 */
class PrestamoSearch extends Prestamo
{
    /**
     * @inheritdoc
     */
     public function attributes()
    {
        // add related fields to searchable attributes
      return array_merge(parent::attributes(), ['estado.prenda']);

    }
    public function rules()
    {
        return [
            [['idPrestamo', 'idPrenda', 'idUsuarioDa', 'idUsuarioUsa'], 'integer'],
            [['fechaInicio', 'fechaFinal'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Prestamo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idPrestamo' => $this->idPrestamo,
            'idPrenda' => $this->idPrenda,
            'idUsuarioDa' => $this->idUsuarioDa,
            //'idUsuarioUsa' => $this->idUsuarioUsa,
            'idUsuarioUsa' => Yii::$app->user->id,
            'fechaInicio' => $this->fechaInicio,
            'fechaFinal' => $this->fechaFinal,

        ])
        //->andFilterWhere(['LIKE', 'Libre', $this->estado]);

        ;

        return $dataProvider;
    }
}
