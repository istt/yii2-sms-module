<?php

namespace istt\sms\models;

use Yii;
use yii\base\Behavior;
use yii\behaviors\TimestampBehavior;

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
	const ENABLE = 1;
	const DISABLE = 0;

	const TYPE_ALL = 0;
	const TYPE_LIMITED = 1;
	const TYPE_CUSTOM = 2;
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
            [['title', 'description', 'userid', 'status', 'expired', 'smscount'], 'required'],
            [['description'], 'string'],
            [['userid', 'status', 'smscount'], 'integer'],
            [['expired'], 'safe'],
            [['title'], 'string', 'max' => 255],
        		// Extra rules
        		[['expired'], 'date', 'format' => 'php:Y-m-d'],
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

    public function behaviors(){
    	return [
    			'timestamp' => [
    					'class' => TimestampBehavior::className(),
    					'createdAtAttribute' => 'createtime',
    					'updatedAtAttribute' => 'updatetime',
    			]

    	];
    }

    /**
     * Calculate SMS Left
     * @return number|NULL
     */
    public function getSmsleft(){
    	if ($this->getPrimaryKey())
    		return $this->smscount - self::getDb()->createCommand("
    				SELECT SUM(`smsblock`) FROM cporder
    					LEFT JOIN campaign ON cporder.cid = campaign.id
    					WHERE
    						((campaign.status=1 AND campaign.approved=1)
    						OR campaign.finished=1)
    						AND cporder.oid=" . $this->getPrimaryKey())
    		->queryScalar();
    	else return NULL;
    }
}
