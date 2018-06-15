<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Server;

/**
 * ServerSearch represents the model behind the search form about `app\models\Server`.
 */
class ServerSearch extends Server
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idServer'], 'integer'],
            [['server', 'location', 'nameSoft', 'version', 'link', 'comment'], 'safe'],
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
        $query = Server::find();

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
            'idServer' => $this->idServer,
        ]);

        $query->andFilterWhere(['like', 'server', $this->server])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'nameSoft', $this->nameSoft])
            ->andFilterWhere(['like', 'version', $this->version])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
