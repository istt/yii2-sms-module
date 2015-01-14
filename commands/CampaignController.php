<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace istt\sms\commands;

use Yii;
use yii\console\Controller;
/**
 * Task runner command for development.
 * @package console\controllers
 * @author Tobias Munk <tobias@diemeisterei.de>
 */
class CampaignController extends Controller
{

	/**
	 * This command echoes what you have entered as the message.
	 * @param string $message the message to be echoed.
	 */
	public function actionIndex($message = 'hello world')
	{
		echo $message . "\n";
	}

}
