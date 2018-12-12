<?php

namespace backend\modules\guard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guard\models\BgPackage;

/**
 * BgPackageSearch represents the model behind the search form about `backend\modules\guard\models\BgPackage`.
 */
class BgPackageSearch extends BgPackage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_package'], 'integer'],
            [['name_package'], 'safe'],
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
        $query = BgPackage::find();

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
            'id_package' => $this->id_package,
        ]);

        $query->andFilterWhere(['like', 'name_package', $this->name_package]);

        return $dataProvider;
    }
}
