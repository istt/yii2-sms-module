<?php
/**
 * Return a list of menu item suitable for display in the main Nav
 */
return [
	['label' => \Yii::t('sms', 'SMS'), 'url' => '#', 'items' => [
		['label' => Yii::t('sms', 'Campaigns'), 'url'=>['/sms/campaign']],
		['label' => Yii::t('sms', 'Organization'), 'url'=>['/sms/organization']],
		['label' => Yii::t('sms', 'SMS Template'), 'url'=>['/sms/template']],
		['label' => Yii::t('sms', 'Email Connections'), 'url'=>['/sms/mailbox']],
		['label' => Yii::t('sms', 'FTP Connections'), 'url'=>['/sms/ftp']],
		['label' => Yii::t('sms', 'Files'), 'url'=>['/sms/file']],
		['label' => Yii::t('sms', 'Worktime'), 'url'=>['/sms/worktime']],
		['label' => Yii::t('sms', 'Sms Order'), 'url'=>['/sms/order']],
		['label' => Yii::t('sms', 'Sendsms'), 'url'=>['/sms/sms']],
		['label' => Yii::t('sms', 'Sentsms'), 'url'=>['/sms/sent']],
		['label' => Yii::t('sms', 'Services'), 'url'=>['/sms/services']],
		['label' => Yii::t('sms', 'Filter'), 'url'=>['/sms/filter/index']],
		['label' => Yii::t('sms', 'Blacklist'), 'url'=>['/sms/blacklist']],
		['label' => Yii::t('sms', 'Whitelist'), 'url'=>['/sms/whitelist']],
		['label' => Yii::t('sms', 'User'), 'url'=>['/sms/user']],
	]]
];