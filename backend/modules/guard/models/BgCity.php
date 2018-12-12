<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_city".
 *
 * @property integer $id_city
 * @property string $name_sity
 * @property integer $id_oblast
 *
 * @property BgOblast $idOblast
 * @property BgUnit[] $bgUnits
 */
class BgCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_sity'], 'required'],
            [['id_oblast'], 'integer'],
            [['name_sity', 'name_oblast'], 'string', 'max' => 256],
            [['id_oblast'], 'exist', 'skipOnError' => true, 'targetClass' => BgOblast::className(), 'targetAttribute' => ['id_oblast' => 'id_oblast']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_city' => 'Id City',
            'name_sity' => 'Name Sity',
            'id_oblast' => 'Id Oblast',
            'name_oblast' => 'Name Oblast'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOblast()
    {
        return $this->hasOne(BgOblast::className(), ['id_oblast' => 'id_oblast']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_city' => 'id_city']);
    }
}
