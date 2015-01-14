<?php

namespace istt\sms;

use yii\console\Application as ConsoleApplication;
use yii\base\Module as BaseModule;
class SmsModule extends BaseModule
{
	/**
	 * @var string The prefix for user module URL.
	 * @See [[GroupUrlRule::prefix]]
	 */
	public $urlPrefix = 'sms';
	/** @var array The rules to be used in URL management. */
	public $urlRules = [
	];
//     public function init()
//     {
//         parent::init();

//         if (\Yii::$app instanceof Application){
//         	$this->controllerNamespace = 'istt\sms\commands';
//         }
//     }
}
