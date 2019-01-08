<?php

namespace backend\modules\guard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guard\models\BgClient;

/**
 * BgClientSearch represents the model behind the search form about `backend\modules\guard\models\BgClient`.
 */
class BgClientSearch extends BgClient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_client', 'id_diller_reteiler', 'count_obj', 'status'], 'integer'],
            [['client_name', 'name_manager', 'contract_number', 'contract_date', 'contact1', 'contact2', 'email', 'comment'], 'safe'],
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
        $query = BgClient::find();

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
            'id_client' => $this->id_client,
            'id_diller_reteiler' => $this->id_diller_reteiler,
            //'id_package' => $this->id_package,
            'contract_date' => $this->contract_date,
            'count_obj' => $this->count_obj,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'name_manager', $this->name_manager])
            ->andFilterWhere(['like', 'contract_number', $this->contract_number])
            ->andFilterWhere(['like', 'contact1', $this->contact1])
            ->andFilterWhere(['like', 'contact2', $this->contact2])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
