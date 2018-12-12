<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_diller".
 *
 * @property integer $id_diller_reteiler
 * @property string $name_diller_reteiler
 *
 * @property BgClient[] $bgClients
 */
class BgDiller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_diller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_diller_reteiler'], 'required'],
            [['name_diller_reteiler'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_diller_reteiler' => 'Id Diller Reteiler',
            'name_diller_reteiler' => 'Name Diller Reteiler',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgClients()
    {
        return $this->hasMany(BgClient::className(), ['id_diller_reteiler' => 'id_diller_reteiler']);
    }
}
