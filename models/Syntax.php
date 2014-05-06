<?php

namespace vendor\istt\sms\models;

use Yii;

/**
 * This is the model class for table "syntax".
 *
 * @property integer $fid
   * @property string $syntax
   * @property integer $type
   *
 * @property Filter $filter
 */
class Syntax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%syntax}}';
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
            [['fid', 'type'], 'required'],
            [['fid', 'type'], 'integer'],
            [['syntax'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fid' => Yii::t('sms', 'Fid'),
            'syntax' => Yii::t('sms', 'Syntax'),
            'type' => Yii::t('sms', 'Type'),
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
