<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_can_sensor".
 *
 * @property integer $id_can_sensor
 * @property string $name_can_sensor
 *
 * @property BgUnit[] $bgUnits
 */
class BgCanSensor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_can_sensor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_can_sensor'], 'required'],
            [['name_can_sensor'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_can_sensor' => 'Id Can Sensor',
            'name_can_sensor' => 'Name Can Sensor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_can' => 'id_can_sensor']);
    }
}
