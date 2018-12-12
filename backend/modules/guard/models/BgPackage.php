<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_package".
 *
 * @property integer $id_package
 * @property string $name_package
 *
 * @property BgClient $bgClient
 */
class BgPackage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_package';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_package'], 'required'],
            [['name_package'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_package' => 'Id Package',
            'name_package' => 'Name Package',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBgClient()
    {
        return $this->hasOne(BgClient::className(), ['id_package' => 'id_package']);
    }
}
