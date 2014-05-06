<?php

namespace vendor\istt\sms\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
   * @property string $username
   * @property string $password
   * @property string $email
   * @property string $activkey
   * @property integer $createtime
   * @property integer $lastvisit
   * @property integer $status
   * @property integer $org
   * @property string $sender
   * @property string $smsprefix
   */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
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
            [['username', 'password', 'email', 'activkey', 'createtime', 'lastvisit', 'status', 'org', 'sender'], 'required'],
            [['createtime', 'lastvisit', 'status', 'org'], 'integer'],
            [['username', 'sender'], 'string', 'max' => 20],
            [['password', 'email', 'activkey'], 'string', 'max' => 128],
            [['smsprefix'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sms', 'ID'),
            'username' => Yii::t('sms', 'Username'),
            'password' => Yii::t('sms', 'Password'),
            'email' => Yii::t('sms', 'Email'),
            'activkey' => Yii::t('sms', 'Activkey'),
            'createtime' => Yii::t('sms', 'Createtime'),
            'lastvisit' => Yii::t('sms', 'Lastvisit'),
            'status' => Yii::t('sms', 'Status'),
            'org' => Yii::t('sms', 'Org'),
            'sender' => Yii::t('sms', 'Sender'),
            'smsprefix' => Yii::t('sms', 'Smsprefix'),

        ];
    }

    /**
    * Extra behavior configuration
    **/
    public function behaviors(){
    	return [
    	];
    }
}
