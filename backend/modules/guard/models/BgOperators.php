<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_operators".
 *
 * @property integer $id_operator
 * @property string $name_operator
 * @property integer $status_operator
 *
 * @property BgUnit[] $bgUnits
 * @property BgUnit[] $bgUnits0
 */
class BgOperators extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_operators';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_operator'], 'required'],
            [['status_operator'], 'integer'],
            [['name_operator'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_operator' => 'Id Operator',
            'name_operator' => 'Name Operator',
            'status_operator' => 'Status Operator',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_activate_operator' => 'id_operator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits0()
    {
        return $this->hasMany(BgUnit::className(), ['id_tester_operator' => 'id_operator']);
    }
}
