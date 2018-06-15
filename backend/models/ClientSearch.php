<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form about `app\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idClient', 'edrpou', 'idType', 'idServer', 'idConract', 'clientCountObj', 'active', 'idSegment'], 'integer'],
            [['clientName', 'structure', 'publicTel', 'publicEmail', 'comment', 'prManager'], 'safe'],
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
        $query = Client::find();
        //->orderBy(['clientName' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'clientName' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('idConract0');


        // grid filtering conditions
        $query->andFilterWhere([
            'idClient' => $this->idClient,
            'edrpou' => $this->edrpou,
            'idType' => $this->idType,
            'idSegment' => $this->idSegment,
            'idServer' => $this->idServer,
            //'idConract' => $this->idConract,
            'clientCountObj' => $this->clientCountObj,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'clientName', $this->clientName])
            ->andFilterWhere(['like', 'structure', $this->structure])
            ->andFilterWhere(['like', 'prManager', $this->prManager])
            ->andFilterWhere(['like', 'publicTel', $this->publicTel])
            //->andFilterWhere(['like', 'Contract.number', $this->idConract])
            ->andFilterWhere(['like', 'Contract.serviceContract', $this->idConract])
            ->andFilterWhere(['like', 'publicEmail', $this->publicEmail])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
