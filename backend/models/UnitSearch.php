<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Unit;

/**
 * UnitSearch represents the model behind the search form about `app\models\Unit`.
 */
class UnitSearch extends Unit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUnit', 'number', 'imei', 'status'], 'integer'],
            [['comment', 'idTypeUnit', 'idSim', 'idIcc', 'idClient'], 'safe'],
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
    public function search($params, $id)
    {
        $query = Unit::find();

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

        $query->joinWith('idClient0');
        $query->joinWith('idSim0', 'idIcc0');
        //$query->joinWith('idIcc0');
        $query->joinWith('idTypeUnit0');

        // grid filtering conditions
        $query->andFilterWhere([
            'idUnit' => $this->idUnit,
            //'status' => $this->status,
            //'number' => $this->number,
            //'imei' => $this->imei,
            //'idTypeUnit' => $this->idTypeUnit,
            //'idSim' => $this->idSim,
            //'idIcc' => $this->idIcc,
            //'idClient' => $this->idClient,
            self::tableName() . '.status' => $this->status,
        ]);
        if($id){
            $query->andFilterWhere(['like', 'client.idClient', $id]);
        }

        $query->andFilterWhere(['like', 'comment', $this->comment])
                ->andFilterWhere(['like', 'Sim.sim', $this->idSim])
                ->andFilterWhere(['like', 'Sim.icc', $this->idIcc])
                ->andFilterWhere(['like', 'imei', $this->imei])
                ->andFilterWhere(['like', 'number', $this->number])
                ->andFilterWhere(['like', 'client.clientName', $this->idClient])
                ->andFilterWhere(['like', 'TypeUnit.name', $this->idTypeUnit]);

        return $dataProvider;
    }
}
