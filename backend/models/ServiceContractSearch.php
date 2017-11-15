<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceContract;

/**
 * ServiceContractSearch represents the model behind the search form about `app\models\ServiceContract`.
 */
class ServiceContractSearch extends ServiceContract
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_service_contract', 'idClient'], 'integer'],
            [['name_service_contract', 'date_service_contract'], 'safe'],
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
        $query = ServiceContract::find();

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
            'id_service_contract' => $this->id_service_contract,
            'date_service_contract' => $this->date_service_contract,
            'idClient' => $this->idClient,
        ]);

        $query->andFilterWhere(['like', 'name_service_contract', $this->name_service_contract]);

        return $dataProvider;
    }
}
