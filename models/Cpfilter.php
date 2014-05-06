<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "cpfilter".
 *
 * @property integer $cid
   * @property integer $fid
   * @property integer $type
   *
 * @property Campaign $campaign
 * @property Filter $filter
 */
class Cpfilter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cpfilter}}';
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
            [['cid', 'fid', 'type'], 'required'],
            [['cid', 'fid', 'type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => Yii::t('sms', 'Cid'),
            'fid' => Yii::t('sms', 'Fid'),
            'type' => Yii::t('sms', 'Type'),
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
    public function getFilter()
    {
        return $this->hasOne(Filter::className(), ['id' => 'fid']);
    }
}
