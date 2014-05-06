<?php

namespace vendor\istt\sms\models;

use Yii;

/**
 * This is the model class for table "cporder".
 *
 * @property integer $cid
 * @property integer $oid
 * @property string $smsblock
 *
 * @property Campaign $campaign
 * @property Order $order
 */
class Cporder extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return '{{%cporder}}';
	}

	/**
	 *
	 * @return \yii\db\Connection the database connection used by this AR class.
	 */
	public static function getDb() {
		return ($db = Yii::$app->get ( 'smsDb' )) ? $db : Yii::$app->db;
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
				[ [ 'cid', 'oid' ], 'required' ],
				[ [ 'cid', 'oid', 'smsblock' ], 'integer' ]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
				'cid' => Yii::t ( 'sms', 'Cid' ),
				'oid' => Yii::t ( 'sms', 'Oid' ),
				'smsblock' => Yii::t ( 'sms', 'Smsblock' )
		]
		;
	}

	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getCampaign() {
		return $this->hasOne ( Campaign::className (), [ 'id' => 'cid' ] );
	}

	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrder() {
		return $this->hasOne ( Order::className (), [ 'id' => 'oid' ] );
	}
}
