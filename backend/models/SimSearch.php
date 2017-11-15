<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sim;

/**
 * SimSearch represents the model behind the search form about `app\models\Sim`.
 */
class SimSearch extends Sim
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idSim', 'status', 'sim'], 'integer'],
            [['icc', 'code'], 'safe'],
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
        $query = Sim::find();

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
            'idSim' => $this->idSim,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'sim', $this->sim])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'icc', $this->icc]);

        return $dataProvider;
    }
}
