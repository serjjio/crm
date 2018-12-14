<?php

namespace backend\modules\guard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guard\models\BgLogin;

/**
 * BgLoginSearch represents the model behind the search form about `backend\modules\guard\models\BgLogin`.
 */
class BgLoginSearch extends BgLogin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_login', 'id_client'], 'integer'],
            [['name_login', 'name_user', 'email'], 'safe'],
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
        $query = BgLogin::find();

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
        $query->joinWith('idClient');
        // grid filtering conditions
        $query->andFilterWhere([
            'id_login' => $this->id_login,
            'id_client' => $this->id_client,
        ]);

        if($id){
            $query->andFilterWhere(['bg_client.id_client' => $id]);
        }

        $query->andFilterWhere(['like', 'name_login', $this->name_login])
            ->andFilterWhere(['like', 'name_user', $this->name_user])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
