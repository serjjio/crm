<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_volume_sensor".
 *
 * @property integer $id_volume_sensor
 * @property string $name_volume_sensor
 *
 * @property BgUnit[] $bgUnits
 */
class BgVolumeSensor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_volume_sensor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_volume_sensor'], 'required'],
            [['name_volume_sensor'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_volume_sensor' => 'Id Volume Sensor',
            'name_volume_sensor' => 'Name Volume Sensor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_volume' => 'id_volume_sensor']);
    }
}
