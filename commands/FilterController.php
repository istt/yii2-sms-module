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
use istt\sms\models\Filter;
/**
 * Task runner command for development.
 * @package console\controllers
 * @author Tobias Munk <tobias@diemeisterei.de>
 */
class FilterController extends Controller
{

	/**
	 * This command echoes what you have entered as the message.
	 * @param string $message the message to be echoed.
	 */
	public function actionIndex($message = 'hello world')
	{
		echo $message . "\n";
	}

	public function actionDummy($cnt = 10){
		$lastFilter = Filter::find()->orderBy(['id' => SORT_DESC])->one();
		$maxId = 0;
		if ($lastFilter){
			$maxId += $lastFilter->id;
		}
		$success = 0;
		for ($i = $maxId; $i < $maxId + $cnt; $i++){
			$filter = new Filter();
			$filter->title= "Dummy Filter #" . $i;
			$filter->description = "A short description for dummy filter #" . $i;
			if ($filter->save()){
				$success++;
			} else {
				var_dump($filter->errors);
			}
		}
		echo "Successfully create $success filter";
	}


}
