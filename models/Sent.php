<?php

namespace vendor\istt\sms\models;

use Yii;

/**
 * This is the model class for table "sent_sms".
 *
 * @property string $momt
   * @property string $sender
   * @property string $receiver
   * @property string $udhdata
   * @property string $msgdata
   * @property string $time
   * @property string $smsc_id
   * @property string $service
   * @property string $account
   * @property string $id
   * @property string $sms_type
   * @property string $mclass
   * @property string $mwi
   * @property string $coding
   * @property string $compress
   * @property string $validity
   * @property string $deferred
   * @property string $dlr_mask
   * @property string $dlr_url
   * @property string $pid
   * @property string $alt_dcs
   * @property string $rpi
   * @property string $charset
   * @property string $boxc_id
   * @property string $binfo
   * @property integer $campaign_id
   * @property string $meta_data
   * @property integer $dlr
   */
class Sent extends Sms
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sent_sms}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return ($db = Yii::$app->get('smsDb'))?$db:Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['momt', 'udhdata', 'msgdata', 'meta_data'], 'string'],
            [['time'], 'required'],
            [['time'], 'safe'],
            [['id', 'sms_type', 'mclass', 'mwi', 'coding', 'compress', 'validity', 'deferred', 'dlr_mask', 'pid', 'alt_dcs', 'rpi', 'campaign_id', 'dlr'], 'integer'],
            [['sender', 'receiver'], 'string', 'max' => 20],
            [['smsc_id', 'service', 'account', 'dlr_url', 'charset', 'boxc_id', 'binfo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'momt' => Yii::t('sms', 'Momt'),
            'sender' => Yii::t('sms', 'Sender'),
            'receiver' => Yii::t('sms', 'Receiver'),
            'udhdata' => Yii::t('sms', 'Udhdata'),
            'msgdata' => Yii::t('sms', 'Msgdata'),
            'time' => Yii::t('sms', 'Time'),
            'smsc_id' => Yii::t('sms', 'Smsc ID'),
            'service' => Yii::t('sms', 'Service'),
            'account' => Yii::t('sms', 'Account'),
            'id' => Yii::t('sms', 'ID'),
            'sms_type' => Yii::t('sms', 'Sms Type'),
            'mclass' => Yii::t('sms', 'Mclass'),
            'mwi' => Yii::t('sms', 'Mwi'),
            'coding' => Yii::t('sms', 'Coding'),
            'compress' => Yii::t('sms', 'Compress'),
            'validity' => Yii::t('sms', 'Validity'),
            'deferred' => Yii::t('sms', 'Deferred'),
            'dlr_mask' => Yii::t('sms', 'Dlr Mask'),
            'dlr_url' => Yii::t('sms', 'Dlr Url'),
            'pid' => Yii::t('sms', 'Pid'),
            'alt_dcs' => Yii::t('sms', 'Alt Dcs'),
            'rpi' => Yii::t('sms', 'Rpi'),
            'charset' => Yii::t('sms', 'Charset'),
            'boxc_id' => Yii::t('sms', 'Boxc ID'),
            'binfo' => Yii::t('sms', 'Binfo'),
            'campaign_id' => Yii::t('sms', 'Campaign ID'),
            'meta_data' => Yii::t('sms', 'Meta Data'),
            'dlr' => Yii::t('sms', 'Dlr'),
        ];
    }
}
