<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_type_unit".
 *
 * @property integer $id_type_unit
 * @property string $name_type_unit
 *
 * @property BgUnit[] $bgUnits
 */
class BgTypeUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_type_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_type_unit'], 'required'],
            [['name_type_unit'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_type_unit' => 'Id Type Unit',
            'name_type_unit' => 'Name Type Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_type_unit' => 'id_type_unit']);
    }
}
