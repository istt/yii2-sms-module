<?php

namespace istt\sms;

class SmsModule extends \yii\base\Module
{
    public $controllerNamespace = 'istt\sms\controllers';

    public function init()
    {
        parent::init();

        if (\Yii::$app instanceof \yii\console\Application) {
        	$this->controllerNamespace = 'istt\sms\commands';
        }

        \Yii::$app->getI18n()->translations['sms'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/messages',
        ];
    }
}
