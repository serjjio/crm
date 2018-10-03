<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Contact".
 *
 * @property integer $idContact
 * @property integer $idClient
 * @property string $contactName
 * @property string $tel
 * @property string $email
 * @property string $comment
 *
 * @property Client $idClient0
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idClient', 'email'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['idClient'], 'integer'],
            [['contactName', 'tel', 'email', 'comment'], 'string', 'max' => 256],
            [['idClient'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['idClient' => 'idClient']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idContact' => 'Id Contact',
            'idClient' => 'Id Client',
            'contactName' => 'Contact Name',
            'tel' => 'Tel',
            'email' => 'Email',
            'comment' => 'Comment',
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
