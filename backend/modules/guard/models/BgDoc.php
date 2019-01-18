<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_doc".
 *
 * @property integer $id_doc
 * @property string $name_path
 * @property string $size
 * @property integer $id_unit
 *
 * @property BgUnit $idUnit
 */
class BgDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;

    public static function tableName()
    {
        return 'bg_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_unit'], 'integer'],
            [['file'], 'file'],
            [['name_path', 'size'], 'string', 'max' => 256],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => BgUnit::className(), 'targetAttribute' => ['id_unit' => 'id_unit']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_doc' => 'Id Doc',
            'name_path' => 'Name Path',
            'size' => 'Size',
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
