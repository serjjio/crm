<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Contract".
 *
 * @property integer $idContract
 * @property string $number
 * @property string $numberContractProvider
 * @property string $otherContract
 * @property string $date_service_contract
 * @property string $comment
 *
 * @property Client[] $clients
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Contract';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'serviceContract'], 'required'],
            [['number', 'numberContractProvider', 'otherContract', 'date_service_contract', 'date_provider_contract', 'comment', 'serviceContract'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idContract' => 'Id Contract',
            'number' => 'Number',
            'numberContractProvider' => 'Number Contract Provider',
            'otherContract' => 'Other Contract',
            'date_service_contract' => 'Date Service Contract',
            'date_provider_contract' => 'Date Provider Contract',
            'serviceContract' => 'Service Contract',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['idConract' => 'idContract']);
    }
}
