<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Segment".
 *
 * @property integer $idSegment
 * @property string $nameSegment
 *
 * @property Client[] $clients
 */
class Segment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Segment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameSegment'], 'required'],
            [['nameSegment'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idSegment' => 'Id Segment',
            'nameSegment' => 'Сегмент',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['idSegment' => 'idSegment']);
    }
}
