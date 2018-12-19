<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_unit".
 *
 * @property integer $id_unit *
 * @property string $unit_number *
 * @property integer $id_client *
 * @property integer $id_type_unit *
 * @property string $sim_number *
 * @property string $test_date *
 * @property integer $id_city *
 * @property integer $id_diller_installer *
 * @property string $installer *
 * @property string $contact_installer *
 * @property integer $test_status *
 * @property integer $can_module *
 * @property integer $shock_sensor *
 * @property integer $volume_sensor *
 * @property integer $rfid_tags *
 * @property string $vin_number *
 * @property integer $id_tester_operator *
 * @property string $activate_date *
 * @property integer $activate_status *
 * @property integer $id_activate_operator *
 * @property string $garant_term *
 * @property integer $id_marka *
 * @property string $name_model
 * @property string $gos_number *
 * @property string $color *
 * @property integer $id_model *
 * @property string $made_auto_date *
 * @property string $passport_number *
 * @property string $name_owner *
 * @property string $comment *
 *
 * @property BgClient $idClient
 * @property BgTypeUnit $idTypeUnit
 * @property BgDillerInstaller $idDillerInstaller
 * @property BgTesterOperator $idTesterOperator
 * @property BgActivateOperator $idActivateOperator
 * @property BgMarka $idMarka
 * @property BgModel $idModel
 * @property BgCity $idCity
 */
class BgUnit extends \yii\db\ActiveRecord
{
    public $file;
    public $id_operator;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
            [['unit_number', 'sim_number'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['unit_number', 'id_client', 'id_type_unit', 'id_city', 'id_diller_installer', 'id_volume', 'id_can', 'test_status', 'can_module', 'shock_sensor', 'volume_sensor', 'rfid_tags', 'id_tester_operator', 'activate_status', 'id_activate_operator', 'id_marka', 'id_model', 'id_segment', 'id_insurance', 'id_operator', 'status'], 'integer'],
            [['unit_number'], 'unique', 'message' => 'Такой номер блока уже существует'],
            [['test_date', 'activate_date', 'made_auto_date'], 'safe'],
            [['sim_number', 'garant_term', 'ext_garant', 'comment'], 'string', 'max' => 32],
            [['installer', 'contact_installer', 'vin_number', 'name_model', 'gos_number', 'color', 'passport_number', 'name_owner'], 'string', 'max' => 256],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => BgClient::className(), 'targetAttribute' => ['id_client' => 'id_client']],
            [['id_type_unit'], 'exist', 'skipOnError' => true, 'targetClass' => BgTypeUnit::className(), 'targetAttribute' => ['id_type_unit' => 'id_type_unit']],
            [['id_diller_installer'], 'exist', 'skipOnError' => true, 'targetClass' => BgDillerAll::className(), 'targetAttribute' => ['id_diller_installer' => 'id_diller']],
            [['id_volume'], 'exist', 'skipOnError' => true, 'targetClass' => BgVolumeSensor::className(), 'targetAttribute' => ['id_volume' => 'id_volume_sensor']],
            [['id_can'], 'exist', 'skipOnError' => true, 'targetClass' => BgCanSensor::className(), 'targetAttribute' => ['id_can' => 'id_can_sensor']],
            [['id_tester_operator'], 'exist', 'skipOnError' => true, 'targetClass' => BgOperators::className(), 'targetAttribute' => ['id_tester_operator' => 'id_operator']],
            [['id_segment'], 'exist', 'skipOnError' => true, 'targetClass' => BgSegment::className(), 'targetAttribute' => ['id_segment' => 'id_segment']],
            [['id_insurance'], 'exist', 'skipOnError' => true, 'targetClass' => BgInsurance::className(), 'targetAttribute' => ['id_insurance' => 'id_insurance']],
            [['id_activate_operator'], 'exist', 'skipOnError' => true, 'targetClass' => BgOperators::className(), 'targetAttribute' => ['id_activate_operator' => 'id_operator']],
            [['id_marka'], 'exist', 'skipOnError' => true, 'targetClass' => BgMarka::className(), 'targetAttribute' => ['id_marka' => 'id_marka']],
            [['id_model'], 'exist', 'skipOnError' => true, 'targetClass' => BgModel::className(), 'targetAttribute' => ['id_model' => 'id_model']],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => BgCity::className(), 'targetAttribute' => ['id_city' => 'id_city']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_unit' => 'Id Unit',
            'unit_number' => 'Unit Number',
            'id_client' => 'Id Client',
            'id_type_unit' => 'Id Type Unit',
            'sim_number' => 'Sim Number',
            'test_date' => 'Test Date',
            'id_city' => 'Id City',
            'id_diller_installer' => 'Id Diller Installer',
            'installer' => 'Installer',
            'contact_installer' => 'Contact Installer',
            'test_status' => 'Test Status',
            'can_module' => 'Can Module',
            'shock_sensor' => 'Shock Sensor',
            'volume_sensor' => 'Volume Sensor',
            'rfid_tags' => 'Rfid Tags',
            'vin_number' => 'Vin Number',
            'id_tester_operator' => 'Id Tester Operator',
            'id_segment' => 'Id Segment',
            'id_insurance' => 'Id Insurance',
            'activate_date' => 'Activate Date',
            'activate_status' => 'Activate Status',
            'id_activate_operator' => 'Id Activate Operator',
            'garant_term' => 'Garant Term',
            'ext_garant' => 'Ext Garant',
            'id_marka' => 'Id Marka',
            'name_model' => 'Name Model',
            'gos_number' => 'Gos Number',
            'color' => 'Color',
            'id_model' => 'Id Model',
            'made_auto_date' => 'Made Auto Date',
            'passport_number' => 'Passport Number',
            'name_owner' => 'Name Owner',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient()
    {
        return $this->hasOne(BgClient::className(), ['id_client' => 'id_client']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypeUnit()
    {
        return $this->hasOne(BgTypeUnit::className(), ['id_type_unit' => 'id_type_unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDillerInstaller()
    {
        return $this->hasOne(BgDillerAll::className(), ['id_diller' => 'id_diller_installer']);
    }

    public function getIdVolume()
    {
        return $this->hasOne(BgVolumeSensor::className(), ['id_volume_sensor' => 'id_volume']);
    }

    public function getIdCan()
    {
        return $this->hasOne(BgCanSensor::className(), ['id_can_sensor' => 'id_can']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTesterOperator()
    {
        return $this->hasOne(BgOperators::className(), ['id_operator' => 'id_tester_operator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSegment()
    {
        return $this->hasOne(BgSegment::className(), ['id_segment' => 'id_segment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInsurance()
    {
        return $this->hasOne(BgInsurance::className(), ['id_insurance' => 'id_insurance']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdActivateOperator()
    {
        return $this->hasOne(BgOperators::className(), ['id_operator' => 'id_activate_operator']);
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
    public function getIdModel()
    {
        return $this->hasOne(BgModel::className(), ['id_model' => 'id_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCity()
    {
        return $this->hasOne(BgCity::className(), ['id_city' => 'id_city']);
    }
}
