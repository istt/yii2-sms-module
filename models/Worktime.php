<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "worktime".
 *
 * @property integer $id
   * @property string $start
   * @property string $end
   *
 * @property Campaign[] $campaigns
 */
class Worktime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%worktime}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return ($db = Yii::$app->get('smsDb'))?$db:Yii::$app->db;
    }

    /**
     * Override loadDefaultValues
     * @see \yii\db\ActiveRecord::loadDefaultValues()
     */
    public function loadDefaultValues($skipIfSet = true){
    	$this->start = date('H:i');
    	$this->end = date('H:i', time() + 180);
    	return parent::loadDefaultValues($skipIfSet);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end'], 'required'],
            [['start', 'end'], 'date', 'format' => 'HHmm']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sms', 'ID'),
            'start' => Yii::t('sms', 'Start'),
            'end' => Yii::t('sms', 'End'),

            'Cpworktime' => Yii::t('sms', 'cpworktime'),
            'Cs' => Yii::t('sms', 'cs'),
        ];
    }

    /**
     * Return the complex key as string
     */
    public $key;
    public function afterFind(){
    	$this->key = $this->start . ' - ' . $this->end;
    	parent::afterFind();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::className(), ['id' => 'cid'])->viaTable(Cpworktime::tableName(), ['tid' => 'id']);
    }
}
