<?php
namespace istt\sms;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;

class Bootstrap implements BootstrapInterface
{
    /** @var array Model's map */
    private $_modelMap = [
    ];

    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('sms') && ($module = $app->getModule('sms')) instanceof Module) {
//             $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);
//             foreach ($this->_modelMap as $name => $definition) {
//                 $class = "istt\\sms\\models\\" . $name;
//                 \Yii::$container->set($class, $definition);
//                 $modelName = is_array($definition) ? $definition['class'] : $definition;
//                 $module->modelMap[$name] = $modelName;
//                 if (in_array($name, ['sms', 'Profile', 'Token', 'Account'])) {
//                     \Yii::$container->set($name . 'Query', function () use ($modelName) {
//                         return $modelName::find();
//                     });
//                 }
//             }
//             \Yii::$container->setSingleton(Finder::className(), [
//                 'userQuery'    => \Yii::$container->get('UserQuery'),
//                 'profileQuery' => \Yii::$container->get('ProfileQuery'),
//                 'tokenQuery'   => \Yii::$container->get('TokenQuery'),
//                 'accountQuery' => \Yii::$container->get('AccountQuery'),
//             ]);
//             \Yii::$container->set('yii\web\User', [
//                 'enableAutoLogin' => true,
//                 'loginUrl'        => ['/user/security/login'],
//                 'identityClass'   => $module->modelMap['sms'],
//             ]);

            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'istt\sms\commands';
            } else {
                $configUrlRule = [
                    'prefix' => $module->urlPrefix,
                    'rules'  => $module->urlRules
                ];

                if ($module->urlPrefix != 'sms') {
                    $configUrlRule['routePrefix'] = 'sms';
                }

                $app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);

//                 if (!$app->has('authClientCollection')) {
//                     $app->set('authClientCollection', [
//                         'class' => 'yii\authclient\Collection',
//                     ]);
//                 }
            }

            $app->get('i18n')->translations['sms*'] = [
                'class'    => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];

//             $defaults = [
//                 'welcomeSubject'        => \Yii::t('sms', 'Welcome to {0}', \Yii::$app->name),
//                 'confirmationSubject'   => \Yii::t('sms', 'Confirm account on {0}', \Yii::$app->name),
//                 'reconfirmationSubject' => \Yii::t('sms', 'Confirm email change on {0}', \Yii::$app->name),
//                 'recoverySubject'       => \Yii::t('sms', 'Complete password reset on {0}', \Yii::$app->name)
//             ];

//             \Yii::$container->set('istt\sms\Mailer', array_merge($defaults, $module->mailer));
        }

    }
}