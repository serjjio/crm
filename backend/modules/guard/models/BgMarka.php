<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_marka".
 *
 * @property integer $id_marka
 * @property string $name_marka
 *
 * @property BgModel[] $bgModels
 * @property BgUnit[] $bgUnits
 */
class BgMarka extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_marka';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_marka'], 'required'],
            [['name_marka'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_marka' => 'Id Marka',
            'name_marka' => 'Name Marka',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgModels()
    {
        return $this->hasMany(BgModel::className(), ['id_marka' => 'id_marka']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_marka' => 'id_marka']);
    }
}
