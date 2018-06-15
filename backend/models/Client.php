<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $idClient
 * @property string $clientName
 * @property string $structure
 * @property string $segment
 * @property integer $edrpou
 * @property string $publicTel
 * @property string $publicEmail
 * @property integer $idType
 * @property integer $idServer
 * @property integer $idConract
 * @property integer $clientCountObj
 *
 * @property Contact[] $contacts
 * @property UserInfo[] $userInfos
 * @property Type $idType0
 * @property Contract $idConract0
 * @property Server $idServer0
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $numberContractProvider;
    public $date_service_contract;
    public $date_provider_contract;
    public $serviceContract;
    public $imgLogo;
    public $service_cont;
    public $active_obj;
    public $inactive_obj;
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientName', 'idType', 'idConract'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['edrpou', 'idType', 'idServer', 'idConract', 'active', 'idSegment'], 'integer'],
            [['clientName'], 'string', 'max' => 250],
             [['imgLogo'], 'file', 'extensions' => ['png', 'jpg', 'gif', 'bmp']],
            [['comment', 'clientCountObj', 'numberContractProvider', 'service_cont'], 'safe'],
            [['structure', 'publicTel', 'date_service_contract', 'date_provider_contract', 'serviceContract', 'otherTel1', 'otherTel2', 'otherEmail2','otherEmail1', 'logo', 'prManager', 'name1', 'name2'], 'string', 'max' => 256],
            ['publicEmail', 'trim'],
            ['publicEmail', 'required', 'message' => 'Необходимо заполнить поле'],
            ['publicEmail', 'email'],
            ['publicEmail', 'string', 'max' => 255],
            
            [['idType'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['idType' => 'idType']],
            [['idSegment'], 'exist', 'skipOnError' => true, 'targetClass' => Segment::className(), 'targetAttribute' => ['idSegment' => 'idSegment']],
            [['idConract'], 'exist', 'skipOnError' => true, 'targetClass' => Contract::className(), 'targetAttribute' => ['idConract' => 'idContract']],
            [['idServer'], 'exist', 'skipOnError' => true, 'targetClass' => Server::className(), 'targetAttribute' => ['idServer' => 'idServer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idClient' => 'Id Client',
            'clientName' => 'Имя Клиента',
            'structure' => 'Structure',
            'idSegment' => 'Id Segment',
            'edrpou' => 'Edrpou',
            'publicTel' => 'Public Tel',
            'publicEmail' => 'Public Email',
            'idType' => 'Id Type',
            'idServer' => 'Id Server',
            'idConract' => 'Id Conract',
            'clientCountObj' => 'Client Count Obj',
            'comment' => 'Comment',
            'numberContractProvider' => 'numberContractProvider',
            'date_service_contract' => 'date_service_contract',
            'date_provider_contract' => 'date_provider_contract',
            'serviceContract' => 'serviceContract',
            'otherTel1' => 'otherTel1',
            'otherTel2' => 'otherTel2',
            'otherEmail2' => 'otherEmail2',
            'otherEmail1' => 'otherEmail1',
            'logo' => 'logo',
            'prManager' => 'Project manager',
            'name1' => 'name1',
            'name2' => 'name2',
            'service_cont' => 'Serv Contr',
            'active_obj',
            'inactive_obj'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['idClient' => 'idClient']);
    }

    public function getServiceContract()
    {
        return $this->hasMany(ServiceContract::className(), ['idClient' => 'idClient']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfos()
    {
        return $this->hasMany(UserInfo::className(), ['idClient' => 'idClient']);
    }
    public function getObjects()
    {
        return $this->hasMany(Object::className(), ['idClient' => 'idClient']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdType0()
    {
        return $this->hasOne(Type::className(), ['idType' => 'idType']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSegment0()
    {
        return $this->hasOne(Segment::className(), ['idSegment' => 'idSegment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConract0()
    {
        return $this->hasOne(Contract::className(), ['idContract' => 'idConract']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdServer0()
    {
        return $this->hasOne(Server::className(), ['idServer' => 'idServer']);
    }
}
