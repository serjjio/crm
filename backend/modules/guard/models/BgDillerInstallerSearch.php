<?php

namespace backend\modules\guard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guard\models\BgDillerInstaller;

/**
 * BgDillerInstallerSearch represents the model behind the search form about `backend\modules\guard\models\BgDillerInstaller`.
 */
class BgDillerInstallerSearch extends BgDillerInstaller
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_diller_installer', 'id_city'], 'integer'],
            [['name_diller_installer', 'name_city'], 'safe'],
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
        $query = BgDillerInstaller::find();

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
            'id_diller_installer' => $this->id_diller_installer,
            'id_city' => $this->id_city,
        ]);

        $query->andFilterWhere(['like', 'name_diller_installer', $this->name_diller_installer])
            ->andFilterWhere(['like', 'name_city', $this->name_city]);

        return $dataProvider;
    }
}
