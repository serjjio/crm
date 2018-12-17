<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_client".
 *
 * @property integer $id_client
 * @property string $client_name
 * @property integer $id_diller_reteiler
 * @property string $name_manager
 * @property integer $id_package
 * @property string $contract_number
 * @property string $contract_date
 * @property string $contact1
 * @property string $contact2
 * @property string $email
 * @property string $comment
 *
 * @property BgDiller $idDillerReteiler
 * @property BgPackage $idPackage
 * @property BgLogin[] $bgLogins
 * @property BgUnit[] $bgUnits
 */
class BgClient extends \yii\db\ActiveRecord
{
    public $active_obj;
    public $inactive_obj;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_name'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['id_diller_reteiler', 'count_obj', 'status'], 'integer'],
            [['contract_date', 'id_package', 'contract_number'], 'safe'],
            [['comment'], 'string'],
            [['client_name', 'name_manager', 'contract_number', 'contact1', 'contact2'], 'string', 'max' => 256],
            ['email', 'trim'],
            //['email', 'required', 'message' => 'Необходимо заполнить поле'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['id_diller_reteiler'], 'exist', 'skipOnError' => true, 'targetClass' => BgDillerAll::className(), 'targetAttribute' => ['id_diller_reteiler' => 'id_diller']],
            [['id_package'], 'exist', 'skipOnError' => true, 'targetClass' => BgPackage::className(), 'targetAttribute' => ['id_package' => 'id_package']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_client' => 'Id Client',
            'client_name' => 'Client Name',
            'id_diller_reteiler' => 'Id Diller Reteiler',
            'name_manager' => 'Name Manager',
            'id_package' => 'Id Package',
            'contract_number' => 'Contract Number',
            'contract_date' => 'Contract Date',
            'contact1' => 'Contact1',
            'contact2' => 'Contact2',
            'email' => 'Email',
            'comment' => 'Comment',
            'count_obj' => 'Count Obj',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDillerReteiler()
    {
        return $this->hasOne(BgDillerAll::className(), ['id_diller' => 'id_diller_reteiler']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPackage()
    {
        return $this->hasOne(BgPackage::className(), ['id_package' => 'id_package']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgLogins()
    {
        return $this->hasMany(BgLogin::className(), ['id_client' => 'id_client']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_client' => 'id_client']);
    }
}
