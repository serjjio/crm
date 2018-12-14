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
            [['name_diller_installer', 'id_city'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['name_diller_installer', 'name_city'], 'string', 'max' => 256],
            [['id_city'], 'integer'],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => BgCity::className(), 'targetAttribute' => ['id_city' => 'id_city']],
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

    public function getIdCity()
    {
        return $this->hasOne(BgCity::className(), ['id_city' => 'id_city']);
    }
}
