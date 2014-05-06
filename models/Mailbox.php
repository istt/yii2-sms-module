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

    /**
     * Run before validate()
     */
    public function beforeValidate() {
    	if (is_array($this->option)) $this->option = implode('/', $this->option);
    	return parent::beforeValidate();
    }
    public function afterFind(){
    	if (! is_array($this->option)) $this->option = explode('/', $this->option);
    	return parent::afterFind();
    }
    /**
     * List available options for php_imap.
     * @param string $param	The option value to reference for.
     */
    public static function optionOption($param = NULL) {
    	$options = array(
    			'debug' => Yii::t('sms', 'Enable Debug'),
    			'secure' => Yii::t('sms', 'Do not transmit a plaintext password over the network'),
    			'imap' => Yii::t('sms', 'Using IMAP service'),
    			'pop3' => Yii::t('sms', 'Using POP3 service'),
    			'nntp' => Yii::t('sms', 'Using NNTP service'),
    			'norsh' => Yii::t('sms', 'Do not use rsh or ssh to establish a preauthenticated IMAP session'),
    			'ssl' => Yii::t('sms', 'Use the Secure Socket Layer to encrypt the session'),
    			'novalidate-cert' => Yii::t('sms', 'Do not validate certificates from TLS SSL server'),
    			'tls' => Yii::t('sms', 'Force use of start-TLS to encrypt the session, and reject connection to servers that do not support it'),
    			'notls' => Yii::t('sms', 'Do not do start-TLS to encrypt the session, even with servers that support it'),
    			'readonly' => Yii::t('sms', 'Request read-only mailbox open (IMAP only; ignored on NNTP, and an error with SMTP and POP3)'),
    	);
    	if (is_null($param)) return $options;
    	elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
    	else return NULL;
    }

    function getMailbox() {
    	return '{' . trim($this->hostname) . '/' . trim($this->option) . '}INBOX';
    }

    function getStatus(){
    	if (is_null($this->status)) {
    		$mailbox = $this->openMailbox();
    		if ($mailbox === FALSE){
    			$this->status = FALSE;
    		} else {
    			$this->status = TRUE;
    			imap_close($mailbox);
    		}
    	}
    	return $this->status;
    }

    function openMailbox() {
    	if (! function_exists('imap_open')) return FALSE;
    	$connection = @imap_open($this->getMailbox(), $this->getUsername(), $this->password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'));
    	return $connection;
    }

    public function getUsername(){
    	if (empty($this->username)) {
    		$this->username = explode('@', $this->email);
    		$this->username = $this->username[0];
    	}
    	return $this->username;
    }
}
