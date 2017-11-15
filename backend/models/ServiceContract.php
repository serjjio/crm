<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_contract".
 *
 * @property integer $id_service_contract
 * @property string $name_service_contract
 * @property string $date_service_contract
 * @property integer $idClient
 *
 * @property Client $idClient0
 */
class ServiceContract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_contract';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_service_contract', 'idClient'], 'required'],
            [['date_service_contract', 'description_service_contract'], 'safe'],
            [['idClient'], 'integer'],
            [['name_service_contract'], 'string', 'max' => 256],
            [['idClient'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['idClient' => 'idClient']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_service_contract' => 'Id Service Contract',
            'name_service_contract' => 'Name Service Contract',
            'date_service_contract' => 'Date Service Contract',
            'idClient' => 'Id Client',
            'description_service_contract' => 'Description'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient0()
    {
        return $this->hasOne(Client::className(), ['idClient' => 'idClient']);
    }
}
