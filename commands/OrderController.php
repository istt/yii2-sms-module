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
use istt\sms\models\Order;
/**
 * Task runner command for development.
 * @package console\controllers
 * @author Tobias Munk <tobias@diemeisterei.de>
 */
class OrderController extends Controller
{

	/**
	 * Generate a specified number of order into database
	 * @param number $num
	 */
	public function actionGenerate($num = 10){
		$lastOrder = Order::find()->orderBy(['id' => SORT_DESC])->one();
		$maxId = (($lastOrder)?$lastOrder->id:0) + 1;
		$success = 0;
		for ($i = $maxId; $i < $maxId + $num; $i++){
			$newOrder = new Order();
			$newOrder->setAttributes([
					'title' => 'Dummy Order #' . $i,
					'description' => 'Dummy Description for Order #' . $i,
					'userid' => 1,
					'status' => Order::ENABLE,
					'expired' => date('%Y-%m-%d', time() + rand(10, 30) * 24 * 60 * 60),
					'smscount' => rand(1000, 9999)
			]);
			if ($newOrder->save()){
				$success += 1;
			} else {
				var_dump($newOrder->errors);
			}
		}
		echo "Successfully create $success order";
	}


}
