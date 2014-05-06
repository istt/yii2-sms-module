<?php

namespace vendor\istt\sms\models;

use Yii;
use vendor\istt\fbads\models\Campaign;

/**
 * This is the model class for table "ftpsetting".
 *
 * @property integer $id
   * @property string $title
   * @property string $description
   * @property string $hostname
   * @property string $username
   * @property string $password
   * @property string $path
   */
class Ftp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ftpsetting}}';
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
            [['title', 'description', 'hostname', 'username', 'password'], 'required'],
            [['description'], 'string'],
            [['title', 'path'], 'string', 'max' => 255],
            [['hostname', 'username', 'password'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sms', 'ID'),
            'title' => Yii::t('sms', 'Title'),
            'description' => Yii::t('sms', 'Description'),
            'hostname' => Yii::t('sms', 'Hostname'),
            'username' => Yii::t('sms', 'Username'),
            'password' => Yii::t('sms', 'Password'),
            'path' => Yii::t('sms', 'Path'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
            return $this->hasMany(Campaign::className(), ['ftpserver' => 'id']);
    }
}
