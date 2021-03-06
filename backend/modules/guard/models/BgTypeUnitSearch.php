<?php

namespace backend\modules\guard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guard\models\BgTypeUnit;

/**
 * BgTypeUnitSearch represents the model behind the search form about `backend\modules\guard\models\BgTypeUnit`.
 */
class BgTypeUnitSearch extends BgTypeUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_type_unit'], 'integer'],
            [['name_type_unit'], 'safe'],
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
        $query = BgTypeUnit::find();

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
            'id_type_unit' => $this->id_type_unit,
        ]);

        $query->andFilterWhere(['like', 'name_type_unit', $this->name_type_unit]);

        return $dataProvider;
    }
}
