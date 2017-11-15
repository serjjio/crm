<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Segment;

/**
 * SegmentSearch represents the model behind the search form about `app\models\Segment`.
 */
class SegmentSearch extends Segment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idSegment'], 'integer'],
            [['nameSegment'], 'safe'],
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
        $query = Segment::find();

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
            'idSegment' => $this->idSegment,
        ]);

        $query->andFilterWhere(['like', 'nameSegment', $this->nameSegment]);

        return $dataProvider;
    }
}
