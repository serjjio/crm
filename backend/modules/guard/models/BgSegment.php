<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_segment".
 *
 * @property integer $id_segment
 * @property string $name_segment
 *
 * @property BgUnit[] $bgUnits
 */
class BgSegment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_segment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_segment'], 'required'],
            [['name_segment'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_segment' => 'Id Segment',
            'name_segment' => 'Name Segment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_segment' => 'id_segment']);
    }
}
