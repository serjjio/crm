<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "object".
 *
 * @property integer $id
 * @property integer $idClient
 * @property integer $number
 *
 * @property Client $idClient0
 */
class Object extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idClient', 'number'], 'required'],
            [['idClient', 'number'], 'integer'],
            [['idClient'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['idClient' => 'idClient']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idClient' => 'Name Client',
            'number' => 'Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient0()
    {
        return $this->hasOne(Client::className(), ['idClient' => 'idClient']);
    }
}
