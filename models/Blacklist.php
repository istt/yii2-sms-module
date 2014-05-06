<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "blacklist".
 *
 * @property integer $fid
   * @property string $isdn
   * @property Filter $filter
   */
class Blacklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blacklist}}';
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
            [['fid'], 'required'],
            [['fid'], 'integer'],
            [['isdn'], 'string', 'max' => 20],
            [['isdn'], 'unique', 'targetAttribute' => ['fid', 'isdn']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fid' => Yii::t('sms', 'Filter'),
            'isdn' => Yii::t('sms', 'ISDN'),

        ];
    }
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFilter()
	{
	        return $this->hasOne(Filter::className(), ['id' => 'fid']);
	}
}
