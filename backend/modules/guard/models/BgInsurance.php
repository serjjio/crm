<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_insurance".
 *
 * @property integer $id_insurance
 * @property string $name_insurance
 *
 * @property BgUnit[] $bgUnits
 */
class BgInsurance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_insurance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_insurance'], 'required'],
            [['name_insurance'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_insurance' => 'Id Insurance',
            'name_insurance' => 'Name Insurance',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_insurance' => 'id_insurance']);
    }
}
