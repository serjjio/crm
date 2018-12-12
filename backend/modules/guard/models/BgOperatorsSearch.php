<?php

namespace backend\modules\guard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guard\models\BgOperators;

/**
 * BgOperatorsSearch represents the model behind the search form about `backend\modules\guard\models\BgOperators`.
 */
class BgOperatorsSearch extends BgOperators
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_operator', 'status_operator'], 'integer'],
            [['name_operator'], 'safe'],
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
        $query = BgOperators::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'status_operator' => SORT_DESC,
                ]
            ]

        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if($this->status_operator == 2){
            $this->status_operator = '';
        }
        //var_dump($this->status_operator);
        // grid filtering conditions
        $query->andFilterWhere([
            'id_operator' => $this->id_operator,
            'status_operator' => $this->status_operator,
            
        ]);

        $query->andFilterWhere(['like', 'name_operator', $this->name_operator]);
        

        return $dataProvider;
    }
}
