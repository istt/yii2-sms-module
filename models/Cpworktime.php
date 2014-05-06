<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "cpworktime".
 *
 * @property integer $cid
   * @property integer $tid
   *
 * @property Campaign $campaign
 * @property Worktime $worktime
 */
class Cpworktime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cpworktime}}';
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
            [['cid', 'tid'], 'required'],
            [['cid', 'tid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => Yii::t('sms', 'Cid'),
            'tid' => Yii::t('sms', 'Tid'),

            'C' => Yii::t('sms', 'c'),
            'T' => Yii::t('sms', 't'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'cid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorktime()
    {
        return $this->hasOne(Worktime::className(), ['id' => 'tid']);
    }

    /**
    * Extra behavior configuration
    **/
    public function behaviors(){
    	return [
    	];
    }
}
