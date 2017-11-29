<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserInfo;

/**
 * UserInfoSearch represents the model behind the search form about `app\models\UserInfo`.
 */
class UserInfoSearch extends UserInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idClient', 'idServer'], 'integer'],
            [['login', 'nameUser', 'email', 'clientSoft', 'comment'], 'safe'],
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
    public function search($params, $id)
    {
        $query = UserInfo::find();

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
        $query->joinWith('idClient0');
        // grid filtering conditions
        
        $query->andFilterWhere([
            'idUser' => $this->idUser,
            //'client.idClient' => $id,
            'idServer' => $this->idServer,
        ]);
        //$query->andFilterWhere(['client.idClient' => $id]);
        if($id){
            $query->andFilterWhere(['client.idClient' => $id]);
        }
        $query->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'nameUser', $this->nameUser])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'clientSoft', $this->clientSoft]);

        return $dataProvider;
    }
}
