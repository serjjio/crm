<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_oblast".
 *
 * @property integer $id_oblast
 * @property string $name_oblast
 *
 * @property BgCity[] $bgCities
 */
class BgOblast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_oblast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_oblast'], 'required'],
            [['name_oblast'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_oblast' => 'Id Oblast',
            'name_oblast' => 'Name Oblast',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgCities()
    {
        return $this->hasMany(BgCity::className(), ['id_oblast' => 'id_oblast']);
    }
}
