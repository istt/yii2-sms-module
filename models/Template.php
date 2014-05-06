<?php

namespace vendor\istt\sms\models;

use Yii;

/**
 * This is the model class for table "template".
 *
 * @property integer $id
   * @property string $title
   * @property string $body
   */
class Template extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%template}}';
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
            [['body'], 'string'],
            [['title'], 'string', 'max' => 40]
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
            'body' => Yii::t('sms', 'Body'),

        ];
    }

    /**
    * Extra behavior configuration
    **/
    public function behaviors(){
    	return [
    	];
    }
}
