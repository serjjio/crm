<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_model".
 *
 * @property integer $id_model
 * @property string $name_model
 * @property integer $id_marka
 *
 * @property BgMarka $idMarka
 * @property BgUnit[] $bgUnits
 */
class BgModel extends \yii\db\ActiveRecord
{

    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_model', 'id_marka'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['id_marka'], 'integer'],
            //[['name_model'], 'safe'],
            [['name_model'], 'unique', 'message' => 'Такая модель уже существует'],
            [['id_marka'], 'exist', 'skipOnError' => true, 'targetClass' => BgMarka::className(), 'targetAttribute' => ['id_marka' => 'id_marka']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_model' => 'Id Model',
            'name_model' => 'Name Model',
            'id_marka' => 'Id Marka',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMarka()
    {
        return $this->hasOne(BgMarka::className(), ['id_marka' => 'id_marka']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgUnits()
    {
        return $this->hasMany(BgUnit::className(), ['id_model' => 'id_model']);
    }
}
