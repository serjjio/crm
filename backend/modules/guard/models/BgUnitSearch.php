<?php

namespace backend\modules\guard\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\guard\models\BgUnit;

/**
 * BgUnitSearch represents the model behind the search form about `backend\modules\guard\models\BgUnit`.
 */
class BgUnitSearch extends BgUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_unit', 'unit_number', 'id_city', 'id_diller_installer', 'test_status', 'can_module', 'shock_sensor', 'volume_sensor', 'rfid_tags', 'id_tester_operator', 'activate_status', 'id_activate_operator', 'id_marka', 'status'], 'integer'],
            [['sim_number', 'test_date', 'id_type_unit', 'installer', 'contact_installer', 'vin_number', 'activate_date', 'garant_term', 'name_model', 'gos_number', 'color', 'made_auto_date', 'passport_number', 'name_owner', 'comment', 'id_model', 'id_client', 'from_date', 'to_date', 'from_date_act', 'to_date_act'], 'safe'],
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
        $query = BgUnit::find();

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
        if(!is_null($this->test_date)){
            if(strpos($this->test_date, ':')!==false){
                list($start_date, $end_date)=explode(':', $this->test_date);
                $query->andFilterWhere(['between', 'test_date', $start_date, $end_date]);
            }else{
                $query->andFilterWhere(['test_date' => $this->test_date]);
            }
        }
        if(!is_null($this->activate_date)){
            if(strpos($this->activate_date, ':')!==false){
                list($start_date, $end_date)=explode(':', $this->activate_date);
                $query->andFilterWhere(['between', 'activate_date', $start_date, $end_date]);
            }else{
                $query->andFilterWhere(['activate_date' => $this->activate_date]);
            }
        }
        $query->joinWith('idTypeUnit');
        $query->joinWith('idModel');
        $query->joinWith('idClient');

        // grid filtering conditions
        $query->andFilterWhere([
            'id_unit' => $this->id_unit,
            //'unit_number' => $this->unit_number,
            //'id_type_unit' => $this->id_type_unit,
            //'test_date' => $this->test_date,
            'id_city' => $this->id_city,
            'id_diller_installer' => $this->id_diller_installer,
            'test_status' => $this->test_status,
            'can_module' => $this->can_module,
            'shock_sensor' => $this->shock_sensor,
            'volume_sensor' => $this->volume_sensor,
            'rfid_tags' => $this->rfid_tags,
            'id_tester_operator' => $this->id_tester_operator,
            //'activate_date' => $this->activate_date,
            'activate_status' => $this->activate_status,
            'id_activate_operator' => $this->id_activate_operator,
            'id_marka' => $this->id_marka,
            self::tableName() . '.status' => $this->status,
            //'id_model' => $this->id_model,
            'made_auto_date' => $this->made_auto_date,
            'comment' => $this->comment,
        ]);
        if($id){
            $query->andFilterWhere(['bg_client.id_client' => $id]);
        }

        $query->andFilterWhere(['like', 'sim_number', $this->sim_number])
            ->andFilterWhere(['like', 'installer', $this->installer])
            ->andFilterWhere(['like', 'bg_type_unit.name_type_unit', $this->id_type_unit])
            ->andFilterWhere(['>=', 'test_date', $this->from_date])
            ->andFilterWhere(['<=', 'test_date', $this->to_date])
            ->andFilterWhere(['>=', 'test_date', $this->from_date_act])
            ->andFilterWhere(['<=', 'test_date', $this->to_date_act])
            ->andFilterWhere(['like', 'bg_client.client_name', $this->id_client])
            ->andFilterWhere(['like', 'bg_model.name_model', $this->id_model])
            ->andFilterWhere(['like', 'contact_installer', $this->contact_installer])
            ->andFilterWhere(['like', 'vin_number', $this->vin_number])
            ->andFilterWhere(['like', 'garant_term', $this->garant_term])
            ->andFilterWhere(['like', 'name_model', $this->name_model])
            ->andFilterWhere(['like', 'gos_number', $this->gos_number])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'unit_number', $this->unit_number])
            ->andFilterWhere(['like', 'passport_number', $this->passport_number])
            ->andFilterWhere(['like', 'name_owner', $this->name_owner]);

        return $dataProvider;
    }
}
