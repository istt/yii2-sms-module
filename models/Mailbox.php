<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "emailsetting".
 *
 * @property integer $id
   * @property string $hostname
   * @property string $email
   * @property string $password
   * @property string $option
   * @property Campaign[] $campaigns
   */
class Mailbox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%emailsetting}}';
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
            [['hostname', 'email', 'password', 'option'], 'required'],
            [['hostname'], 'string', 'max' => 40],
            [['email', 'password', 'option'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sms', 'ID'),
            'hostname' => Yii::t('sms', 'Hostname'),
            'email' => Yii::t('sms', 'Email'),
            'password' => Yii::t('sms', 'Password'),
            'option' => Yii::t('sms', 'Option'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
            return $this->hasMany(Campaign::className(), ['emailbox' => 'id']);
    }
}
