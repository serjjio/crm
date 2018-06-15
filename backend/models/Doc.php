<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doc".
 *
 * @property integer $idDoc
 * @property string $docName
 * @property integer $idClient
 * @property string $size
 *
 * @property Client $idClient0
 */
class Doc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $doc_file;

    public static function tableName()
    {
        return 'doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['docName', 'size'], 'required'],
            [['idClient'], 'integer'],
            [['docName', 'size'], 'string', 'max' => 256],
            [['doc_file'], 'file'],
            [['idClient'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['idClient' => 'idClient']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDoc' => 'Id Doc',
            'docName' => 'Doc Name',
            'idClient' => 'Id Client',
            'size' => 'Size',
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
