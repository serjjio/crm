<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Sim".
 *
 * @property integer $idSim
 * @property string $sim
 * @property string $icc
 *
 * @property Unit[] $units
 * @property Unit[] $units0
 */
class Sim extends \yii\db\ActiveRecord
{
    public $excel;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        
        return 'Sim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sim'], 'required'],
            [['status', 'sim'], 'integer'],
            [['excel'], 'file'],
            [['icc', 'code'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idSim' => 'Id Sim',
            'sim' => 'Сим-карта',
            'icc' => 'ICC',
            'status' => 'Активная/Неактивная',
            'code' => 'Код'

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Unit::className(), ['idSim' => 'idSim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits0()
    {
        return $this->hasMany(Unit::className(), ['idIcc' => 'idSim']);
    }
}
