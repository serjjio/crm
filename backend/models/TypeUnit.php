<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TypeUnit".
 *
 * @property integer $idTypeUnit
 * @property string $name
 *
 * @property Unit[] $units
 */
class TypeUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TypeUnit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTypeUnit' => 'Id Type Unit',
            'name' => 'Название оборудования',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Unit::className(), ['idTypeUnit' => 'idTypeUnit']);
    }
}
