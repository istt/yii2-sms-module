<?php

namespace vendor\istt\sms\models;

use Yii;

/**
 * This is the model class for table "wsuser".
 *
 * @property integer $id
   * @property string $username
   * @property string $password
   * @property string $sender
   */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wsuser}}';
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
            [['username', 'sender'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 255]
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
            'sender' => Yii::t('sms', 'Sender'),

        ];
    }
}
