<?php

namespace vendor\istt\sms\models;

use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property integer $id
   * @property string $title
   * @property string $description
   * @property integer $createtime
   * @property integer $updatetime
   * @property string $codename
   * @property string $request_date
   * @property string $request_owner
   * @property string $datasender
   * @property string $tosubscriber
   * @property string $start
   * @property string $end
   * @property integer $status
   * @property integer $finished
   * @property integer $approved
   * @property integer $active
   * @property string $sender
   * @property integer $ready
   * @property integer $org
   * @property integer $type
   * @property integer $throughput
   * @property integer $col
   * @property integer $isdncol
   * @property string $template
   * @property integer $priority
   * @property integer $velocity
   * @property string $cpworkday
   * @property integer $emailbox
   * @property string $esubject
   * @property string $eattachment
   * @property integer $ftpserver
   * @property string $smsimport
   * @property integer $blockimport
   * @property integer $limit_exceeded
   * @property string $send
   * @property string $blocksend
   * @property string $sent
   * @property string $blocksent
   * @property integer $orderid
   * @property integer $exported
   *
 * @property Cpfile $cpfile
 * @property Datafile[] $fs
 * @property Cpfilter $cpfilter
 * @property Worktime[] $worktimes
 * @property Ftpfilename $ftpfilename
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%campaign}}';
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
            [['description', 'tosubscriber', 'template'], 'string'],
            [['createtime', 'updatetime', 'status', 'finished', 'approved', 'active', 'ready', 'org', 'type', 'throughput', 'col', 'isdncol', 'priority', 'velocity', 'emailbox', 'ftpserver', 'smsimport', 'blockimport', 'limit_exceeded', 'send', 'blocksend', 'sent', 'blocksent', 'orderid', 'exported'], 'integer'],
            [['request_date', 'start', 'end'], 'safe'],
            [['active', 'isdncol', 'cpworkday'], 'required'],
            [['title', 'request_owner'], 'string', 'max' => 40],
            [['codename', 'sender'], 'string', 'max' => 20],
            [['datasender'], 'string', 'max' => 80],
            [['cpworkday'], 'string', 'max' => 10],
            [['esubject', 'eattachment'], 'string', 'max' => 255]
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
            'createtime' => Yii::t('sms', 'Createtime'),
            'updatetime' => Yii::t('sms', 'Updatetime'),
            'codename' => Yii::t('sms', 'Codename'),
            'request_date' => Yii::t('sms', 'Request Date'),
            'request_owner' => Yii::t('sms', 'Request Owner'),
            'datasender' => Yii::t('sms', 'Datasender'),
            'tosubscriber' => Yii::t('sms', 'Tosubscriber'),
            'start' => Yii::t('sms', 'Start'),
            'end' => Yii::t('sms', 'End'),
            'status' => Yii::t('sms', 'Status'),
            'finished' => Yii::t('sms', 'Finished'),
            'approved' => Yii::t('sms', 'Approved'),
            'active' => Yii::t('sms', 'Active'),
            'sender' => Yii::t('sms', 'Sender'),
            'ready' => Yii::t('sms', 'Ready'),
            'org' => Yii::t('sms', 'Org'),
            'type' => Yii::t('sms', 'Type'),
            'throughput' => Yii::t('sms', 'Throughput'),
            'col' => Yii::t('sms', 'Col'),
            'isdncol' => Yii::t('sms', 'Isdncol'),
            'template' => Yii::t('sms', 'Template'),
            'priority' => Yii::t('sms', 'Priority'),
            'velocity' => Yii::t('sms', 'Velocity'),
            'cpworkday' => Yii::t('sms', 'Cpworkday'),
            'emailbox' => Yii::t('sms', 'Emailbox'),
            'esubject' => Yii::t('sms', 'Esubject'),
            'eattachment' => Yii::t('sms', 'Eattachment'),
            'ftpserver' => Yii::t('sms', 'Ftpserver'),
            'smsimport' => Yii::t('sms', 'Smsimport'),
            'blockimport' => Yii::t('sms', 'Blockimport'),
            'limit_exceeded' => Yii::t('sms', 'Limit Exceeded'),
            'send' => Yii::t('sms', 'Send'),
            'blocksend' => Yii::t('sms', 'Blocksend'),
            'sent' => Yii::t('sms', 'Sent'),
            'blocksent' => Yii::t('sms', 'Blocksent'),
            'orderid' => Yii::t('sms', 'Orderid'),
            'exported' => Yii::t('sms', 'Exported'),

            'Cpfile' => Yii::t('sms', 'cpfile'),
            'Fs' => Yii::t('sms', 'fs'),
            'Cpfilter' => Yii::t('sms', 'cpfilter'),
            'Cpworktime' => Yii::t('sms', 'cpworktime'),
            'Ts' => Yii::t('sms', 'ts'),
            'Ftpfilename' => Yii::t('sms', 'ftpfilename'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpfile()
    {
        return $this->hasOne(Cpfile::className(), ['cid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFs()
    {
        return $this->hasMany(Datafile::className(), ['fid' => 'fid'])->viaTable('cpfile', ['cid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpfilter()
    {
        return $this->hasOne(Cpfilter::className(), ['cid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpworktime()
    {
        return $this->hasOne(Cpworktime::className(), ['cid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorktimes()
    {
        return $this->hasMany(Worktime::className(), ['id' => 'tid'])->viaTable(Cpworktime::tableName(), ['cid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFtpfilename()
    {
        return $this->hasOne(Ftpfilename::className(), ['cid' => 'id']);
    }
}
