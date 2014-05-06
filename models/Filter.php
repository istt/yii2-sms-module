<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "filter".
 *
 * @property integer $id
   * @property string $title
   * @property string $reply_refuse
   * @property string $reply_accept
   * @property string $reply_false_syntax
   * @property string $description
   * @property integer $ftpblack
   * @property string $ftpblackfile
   * @property integer $ftpwhite
   * @property string $ftpwhitefile
   * @property string $reply_accept_dup
   * @property string $reply_refuse_dup
   *
 * @property Cpfilter $cpfilter
 * @property Syntax $syntax
 */
class Filter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%filter}}';
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
            [['ftpblack', 'ftpwhite'], 'integer'],
            [['title'], 'string', 'max' => 20],
            [['reply_refuse', 'reply_accept', 'reply_false_syntax', 'description', 'reply_accept_dup', 'reply_refuse_dup'], 'string', 'max' => 256],
            [['ftpblackfile', 'ftpwhitefile'], 'string', 'max' => 255]
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
            'reply_refuse' => Yii::t('sms', 'Reply Refuse'),
            'reply_accept' => Yii::t('sms', 'Reply Accept'),
            'reply_false_syntax' => Yii::t('sms', 'Reply False Syntax'),
            'description' => Yii::t('sms', 'Description'),
            'ftpblack' => Yii::t('sms', 'FTP Server ID for this filter - blacklist sync'),
            'ftpblackfile' => Yii::t('sms', 'Filename prefix for blacklist sync'),
            'ftpwhite' => Yii::t('sms', 'FTP Server ID for this filter - whitelist sync'),
            'ftpwhitefile' => Yii::t('sms', 'Filename prefix for Whitelist sycn'),
            'reply_accept_dup' => Yii::t('sms', 'Reply Accept Dup'),
            'reply_refuse_dup' => Yii::t('sms', 'Reply Refuse Dup'),

            'Cpfilter' => Yii::t('sms', 'cpfilter'),
            'Syntax' => Yii::t('sms', 'syntax'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpfilter()
    {
        return $this->hasOne(Cpfilter::className(), ['fid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSyntax()
    {
        return $this->hasOne(Syntax::className(), ['fid' => 'id']);
    }

    /**
    * Extra behavior configuration
    **/
    public function behaviors(){
    	return [
    	];
    }
}
