<?php

namespace vendor\istt\sms\models;

use Yii;

/**
 * This is the model class for table "whitelist".
 *
 * @property integer $fid
   * @property string $isdn
   */
class Whitelist extends Blacklist
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%whitelist}}';
    }
}
