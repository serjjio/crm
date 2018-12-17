<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_diller_all".
 *
 * @property integer $id_diller
 * @property string $name_diller
 * @property integer $id_city
 * @property string $name_city
 *
 * @property BgClient[] $bgClients
 * @property BgCity $idCity
 * @property BgUnit[] $bgUnits
 */
class BgDillerAll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_diller_all';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_diller'], 'required'],
            [['id_city'], 'integer'],
            [['name_diller', 'name_city'], 'string', 'max' => 256],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => BgCity::className(), 'targetAttribute' => ['id_city' => 'id_city']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_diller' => 'Id Diller',
            'name_diller' => 'Name Diller',
            'id_city' => 'Id City',
            'name_city' => 'Name City',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgClients()
    {
        return $this->hasMany(BgClient::className(), ['id_diller_reteiler' => 'id_diller']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCity()
    {
        return $this->hasOne(BgCity::className(), ['id_city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_diller_installer' => 'id_diller']);
    }
}
