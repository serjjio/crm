<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_diller_installer".
 *
 * @property integer $id_diller_installer
 * @property string $name_diller_installer
 *
 * @property BgUnit[] $bgUnits
 */
class BgDillerInstaller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_diller_installer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_diller_installer'], 'required'],
            [['name_diller_installer'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_diller_installer' => 'Id Diller Installer',
            'name_diller_installer' => 'Name Diller Installer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_diller_installer' => 'id_diller_installer']);
    }
}
