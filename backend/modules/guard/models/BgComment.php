<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_comment".
 *
 * @property integer $id_comment
 * @property string $text_comment
 * @property string $date
 * @property integer $id_user
 * @property integer $id_unit
 *
 * @property BgUnit $idUnit
 */
class BgComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text_comment', 'date', 'id_user'], 'required'],
            [['text_comment'], 'string'],
            [['date', 'username'], 'safe'],
            [['id_user', 'id_unit'], 'integer'],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => BgUnit::className(), 'targetAttribute' => ['id_unit' => 'id_unit']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comment' => 'Id Comment',
            'text_comment' => 'Text Comment',
            'date' => 'Date',
            'id_user' => 'Id User',
            'id_unit' => 'Id Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnit()
    {
        return $this->hasOne(BgUnit::className(), ['id_unit' => 'id_unit']);
    }
}
