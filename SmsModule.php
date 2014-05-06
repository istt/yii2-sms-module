<?php

namespace vendor\istt\sms;

class SmsModule extends \yii\base\Module
{
    public $controllerNamespace = 'vendor\istt\sms\controllers';

    public function init()
    {
        parent::init();

        if (\Yii::$app instanceof \yii\console\Application) {
        	$this->controllerNamespace = 'vendor\istt\sms\commands';
        }

        \Yii::$app->getI18n()->translations['*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/messages',
        ];
    }
}
