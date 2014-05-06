<?php

namespace vendor\istt\sms\models;

use Yii;

/**
 * This is the model class for table "ftpfilename".
 *
 * @property integer $cid
   * @property string $filename
   * @property integer $status
   *
 * @property Campaign $campaign
 */
class Ftpfilename extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ftpfilename}}';
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
            [['cid', 'filename', 'status'], 'required'],
            [['cid', 'status'], 'integer'],
            [['filename'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => Yii::t('sms', 'Cid'),
            'filename' => Yii::t('sms', 'Filename'),
            'status' => Yii::t('sms', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'cid']);
    }
}
