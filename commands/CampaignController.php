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

	/**
	 * This command import a specific campaign into the database
	 * @param number $id
	 */
	public function actionImport($id = 0){

	}

	/**
	 * This command switch all command that are in their running time
	 */
	public function actionActive(){

	}

}
