<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property integer $id
   * @property string $title
   * @property string $description
   * @property integer $created_at
   * @property integer $updated_at
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
	public $filterBlacklistIds;
	public $filterWhitelistIds;
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

    public function init(){
    	parent::init();
    }

    public $gridTitle;
    public $gridStatus;
    public $gridTime;
    public function afterFind(){
    	/*  Calculate mixed attribute based of current attributes   */
    	$this->gridTitle = Yii::t('sms', '<p><big>{title}</big> <small class="text text-info">{codename}</small></p><p>{description}</p><p><code>{template}</code></p>', $this->getAttributes());
    	$this->gridStatus = Yii::t('sms', '{status} {ready} {active} {finished}', [
    			'status' => $this->status?Yii::t('sms', '<span class="label label-primary">Enable</span>'):Yii::t('sms', '<span class="label label-warning">Disable</span>'),
    			'ready' => ($this->ready == 0)?Yii::t('sms', '<span class="label label-default">Not Imported</span>'):(
    					($this->ready == 1)?Yii::t('sms', '<span class="label label-info">Imported</span>'):
    						Yii::t('sms', '<span class="label label-success">Filtered</span>')),
    			'active' => $this->active?Yii::t('sms', '<span class="label label-primary">Active</span>'):Yii::t('sms', '<span class="label label-default">Pending</span>'),
    			'finished' => $this->status?Yii::t('sms', '<span class="label label-success">Finished</span>'):Yii::t('sms', '<span class="label label-default">Not Finished</span>'),
    	]);
    	$this->gridTime = Yii::t('sms', '{start} - {end}', $this->getAttributes());
    	parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'tosubscriber', 'template'], 'string'],
            [['created_at', 'updated_at', 'status', 'finished', 'approved', 'active', 'ready', 'org', 'type', 'throughput', 'col', 'isdncol', 'priority', 'velocity', 'emailbox', 'ftpserver', 'smsimport', 'blockimport', 'limit_exceeded', 'send', 'blocksend', 'sent', 'blocksent', 'orderid', 'exported'], 'integer'],
            [['request_date', 'start', 'end'], 'safe'],
            [['active', 'isdncol', 'cpworkday'], 'required'],
            [['title', 'request_owner'], 'string', 'max' => 40],
            [['codename', 'sender'], 'string', 'max' => 20],
            [['datasender'], 'string', 'max' => 80],
            [['cpworkday'], 'string', 'max' => 10],
            [['esubject', 'eattachment'], 'string', 'max' => 255],
        		// Extra attributes
        		[['filterBlacklistIds', 'filterWhitelistIds'], 'safe']
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
            'created_at' => Yii::t('sms', 'created_at'),
            'updated_at' => Yii::t('sms', 'updated_at'),
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

    const FINISHED_TRUE 	= 1;
    const FINISHED_FALSE	= 0;
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    const APPROVED_TRUE = 1;
    const APPROVED_FALSE= 0;
    const LIMIT_EXCEEDED = 1;
    const LIMIT_AVAILABLE = 0;
    const READY_NOTYET	= 0;
    const READY_IMPORT	= 1;
    const READY_ALL		= 2;

    /** Mandatory Read Only Attributes **/
    public function getSent(){
    	if ($this->getPrimaryKey()){
    		if (! is_null($this->sent) AND ($this->finished == self::FINISHED_TRUE) AND ($this->sent != 0)) return $this->sent;
    			$this->sent = self::getDb()->createCommand("
    				SELECT COUNT(*) FROM sent_sms
    					WHERE campaign_id = " . $this->getPrimaryKey() . " AND ((dlr IS NULL) OR (dlr = 1))"
    				)->queryScalar();
    			if ($this->finished == self::FINISHED_TRUE){
    				$sent = intval($this->sent);
    				self::getDb()->createCommand("
    					UPDATE campaign SET sent=:sent WHERE id=:id ",
    					[':sent' => $sent, ':id' => $this->primaryKey]
    				)->execute();
    			}
    			return $this->sent;
    	} else return NULL;
    }

    public function getBlocksent(){
    	if ($this->getPrimaryKey()){
    		if (! is_null($this->blocksent) AND ($this->finished == self::FINISHED_TRUE) AND ($this->blocksent != 0)) return $this->blocksent;
    		if (strpos($this->template, '{') === FALSE){
    			$this->blocksent = ceil(strlen($this->template) / 160) * $this->getSent();
    		} else {
    			$this->blocksent = self::getDb()->createCommand("SELECT SUM(CEIL(CHAR_LENGTH(msgdata)/160)) AS count FROM {{sent_sms}} WHERE campaign_id = :id AND ((dlr IS NULL) OR (dlr = 1))")->queryScalar([':id' => $this->primaryKey]);
    		}
    		if ($this->finished == self::FINISHED_TRUE){
    			$sent = intval($this->blocksent);
    			self::getDb()->createCommand('UPDATE campaign SET blocksent='.$sent.' WHERE id='.$this->getPrimaryKey())->execute();
    			self::getDb()->createCommand('UPDATE cporder SET smsblock=0 WHERE cid='.$this->getPrimaryKey())->execute();
    			$cporders = Cporder::find()->with('order')->where(['cid' => $this->getPrimaryKey()])->all();
    			$quota = 0;
    			foreach ($cporders as $o){
    				$smsorder = $o->order;
    				if ($smsorder instanceof Order){
    					$quota += $smsorder->getSmsleft();
    				}
    			}
    			if ($sent > $quota)
    				$this->limit_exceeded = Campaign::LIMIT_EXCEEDED;
    			else {
    				foreach ($cporders as $o){
    					$smsorder = $o->order;
    					if (! ($smsorder instanceof Order))
    						continue;
    					$t = $smsorder->getSmsleft();	// so block SMS con lai cua don hang
    					if ($t <= $sent){		// Don hang khong du?
    						$o->smsblock = $t;
    					} else {
    						$o->smsblock = $sent;	// Don hang du?
    					}
    					$sent -= $o->smsblock;
    					$o->save();
    				}
    				$this->limit_exceeded = Campaign::LIMIT_AVAILABLE;
    			}
    		}
    		return $this->blocksent;
    	}
    	return NULL;
    }


    public function getSend(){
    	if ($this->getPrimaryKey()){
    		if (! is_null($this->send) AND ($this->finished == self::FINISHED_TRUE)) return $this->send;
    		$this->send = self::getDb()->createCommand("SELECT COUNT(*) FROM send_sms WHERE campaign_id = " . $this->getPrimaryKey())
    		->queryScalar();
    		if ($this->finished == self::FINISHED_TRUE)
    			self::getDb()->createCommand('UPDATE campaign SET send='.intval($this->send).' WHERE id='.$this->getPrimaryKey())->execute();
    		return $this->send;
    	}
    	else return NULL;
    }

    public function getBlocksend(){
    	if ($this->getPrimaryKey()){
    		if (! is_null($this->blocksend) AND ($this->finished == self::FINISHED_TRUE))  return $this->blocksend;
    		if (strpos($this->template, '{') === FALSE){
    			$this->blocksend = ceil(strlen($this->template) / 160) * $this->getSend();
    		} else {
    			$this->blocksend = self::getDb()->createCommand( "SELECT SUM(CEIL(CHAR_LENGTH(msgdata)/160)) AS count FROM {{send_sms}} WHERE campaign_id = :id")->queryScalar(array(':id' => $this->id));
    		}
    		if ($this->finished == self::FINISHED_TRUE)
    			self::getDb()->createCommand('UPDATE campaign SET blocksend= '.intval($this->blocksend).' WHERE id = '.$this->getPrimaryKey())->execute();
    		return $this->blocksend;
    	}
    	return NULL;
    }

    /* @deprecated
     */
    public function getLimitExceeded(){
    	if ($this->getPrimaryKey()){
    		$smsblock = self::getDb()->createCommand("SELECT SUM(smsblock) FROM cporder WHERE cid = " . $this->getPrimaryKey())->queryScalar();
    		$orderblock = self::getDb()->createCommand("SELECT SUM(smscount) FROM smsorder LEFT JOIN cporder ON cporder.oid=smsorder.id WHERE cporder.cid = " . $this->getPrimaryKey())->queryScalar();
    		if ($this->blockimport > ($orderblock - $smsblock))
    			return self::LIMIT_EXCEEDED;
    		else
    			return self::LIMIT_AVAILABLE;
    	}
    	else return self::LIMIT_AVAILABLE;
    }

}
