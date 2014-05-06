<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "smsorder".
 *
 * @property integer $id
   * @property string $title
   * @property string $description
   * @property integer $userid
   * @property integer $createtime
   * @property integer $updatetime
   * @property integer $status
   * @property string $expired
   * @property string $smscount
   */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%smsorder}}';
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
            [['title', 'description', 'userid', 'createtime', 'updatetime', 'status', 'expired', 'smscount'], 'required'],
            [['description'], 'string'],
            [['userid', 'createtime', 'updatetime', 'status', 'smscount'], 'integer'],
            [['expired'], 'safe'],
            [['title'], 'string', 'max' => 255]
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
            'userid' => Yii::t('sms', 'Userid'),
            'createtime' => Yii::t('sms', 'Createtime'),
            'updatetime' => Yii::t('sms', 'Updatetime'),
            'status' => Yii::t('sms', 'Status'),
            'expired' => Yii::t('sms', 'Expired'),
            'smscount' => Yii::t('sms', 'Smscount'),
        ];
    }
}
