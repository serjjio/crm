<?php

namespace backend\modules\guard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guard\models\BgCity;

/**
 * BgCitySearch represents the model behind the search form about `backend\modules\guard\models\BgCity`.
 */
class BgCitySearch extends BgCity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_city', 'id_oblast'], 'integer'],
            [['name_sity', 'name_oblast'], 'safe'],
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
        $query = BgCity::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'name_oblast' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_city' => $this->id_city,
            'id_oblast' => $this->id_oblast,
        ]);

        $query->andFilterWhere(['like', 'name_sity', $this->name_sity])
            ->andFilterWhere(['like', 'name_oblast', $this->name_oblast]);

        return $dataProvider;
    }
}
