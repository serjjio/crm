<?php

namespace backend\modules\guard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guard\models\BgComment;

/**
 * BgCommentSearch represents the model behind the search form about `backend\modules\guard\models\BgComment`.
 */
class BgCommentSearch extends BgComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_comment', 'id_user', 'id_unit'], 'integer'],
            [['text_comment', 'date', 'username'], 'safe'],
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
    public function search($params, $id = false)
    {
        $query = BgComment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('idUnit');

        // grid filtering conditions
        $query->andFilterWhere([
            'id_comment' => $this->id_comment,
            'date' => $this->date,
            'id_user' => $this->id_user,
            'id_unit' => $this->id_unit,
        ]);
        if($id){
            $query->andFilterWhere(['bg_unit.id_unit' => $id]);
        }

        $query->andFilterWhere(['like', 'text_comment', $this->text_comment])
                ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
