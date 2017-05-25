<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuariogrupo;

/**
 * UsuariogrupoSearch represents the model behind the search form about `app\models\Usuariogrupo`.
 */
class UsuariogrupoSearch extends Usuariogrupo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUsuGrupo', 'idUsuario', 'idGrupo'], 'integer'],
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
        $query = Usuariogrupo::find();

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
            'idUsuGrupo' => $this->idUsuGrupo,
            'idUsuario' => $this->idUsuario,
            'idGrupo' => $this->idGrupo,
        ]);

        $query->andFilterWhere(['idUsuario' => Yii::$app->user->id]);
;

        return $dataProvider;
    }
}
