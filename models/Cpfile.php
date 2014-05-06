<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "cpfile".
 *
 * @property integer $cid
   * @property integer $fid
   * @property integer $status
   *
 * @property Campaign $c
 * @property Datafile $f
 */
class Cpfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cpfile}}';
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
            [['cid', 'fid', 'status'], 'required'],
            [['cid', 'fid', 'status'], 'integer']
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
            'status' => Yii::t('sms', 'Status'),

            'C' => Yii::t('sms', 'c'),
            'F' => Yii::t('sms', 'f'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'cid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getF()
    {
        return $this->hasOne(Datafile::className(), ['fid' => 'fid']);
    }

    /**
    * Extra behavior configuration
    **/
    public function behaviors(){
    	return [
    	];
    }
}
