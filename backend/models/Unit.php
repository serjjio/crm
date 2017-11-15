<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Unit".
 *
 * @property integer $idUnit
 * @property integer $number
 * @property integer $imei
 * @property integer $idTypeUnit
 * @property integer $idSim
 * @property integer $idIcc
 * @property integer $idClient
 * @property string $comment
 *
 * @property TypeUnit $idTypeUnit0
 * @property Sim $idSim0
 * @property Sim $idIcc0
 * @property Client $idClient0
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'imei', 'idTypeUnit'], 'required'],
            [['idClient', 'idSim', 'idIcc', 'comment'], 'safe'],
            [['number', 'imei', 'idTypeUnit', 'idSim', 'idIcc', 'idClient', 'status'], 'integer'],
            [['idTypeUnit'], 'exist', 'skipOnError' => true, 'targetClass' => TypeUnit::className(), 'targetAttribute' => ['idTypeUnit' => 'idTypeUnit']],
            [['idSim'], 'exist', 'skipOnError' => true, 'targetClass' => Sim::className(), 'targetAttribute' => ['idSim' => 'idSim']],
            [['idIcc'], 'exist', 'skipOnError' => true, 'targetClass' => Sim::className(), 'targetAttribute' => ['idIcc' => 'idSim']],
            [['idClient'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['idClient' => 'idClient']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUnit' => 'Id Unit',
            'number' => 'Number',
            'imei' => 'Imei',
            'idTypeUnit' => 'Id Type Unit',
            'idSim' => 'Id Sim',
            'idIcc' => 'Id Icc',
            'idClient' => 'Id Client',
            'comment' => 'Comment',
            'status' => 'Активный/Неактивный'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypeUnit0()
    {
        return $this->hasOne(TypeUnit::className(), ['idTypeUnit' => 'idTypeUnit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSim0()
    {
        return $this->hasOne(Sim::className(), ['idSim' => 'idSim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdIcc0()
    {
        return $this->hasOne(Sim::className(), ['idSim' => 'idIcc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient0()
    {
        return $this->hasOne(Client::className(), ['idClient' => 'idClient']);
    }
}
