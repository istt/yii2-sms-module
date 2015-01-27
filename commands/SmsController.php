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
use istt\sms\models\Campaign;
use yii\db\Query;
use istt\sms\models\Sent;
use yii\helpers\Console;
/**
 * Process SMS for Kannel
 * @package console\controllers
 * @author Nguyen Dinh Trung <ndtrung@istt.com.vn>
 */
class SmsController extends Controller
{

	/**
	 * This command move undelivered SMS from sent_sms to send_sms table for resend.
	 * @param int $campaignID the campaign ID need to check, otherwise all campaign which is finished will be check.
	 */
	public function actionResend($campaignId = null)
	{
		if ($campaignId){
			$campaigns = Campaign::findAll($campaignId);
		} else {
			$campaigns = Campaign::findAll(['finished' => 1, 'approved' => 1, 'end > NOW()']);
		}
		$now = date('Y-m-d H:i:s', time() - 30*60);
		foreach ($campaigns as $c){
			echo $this->ansiFormat(Yii::t('sms', "Trying to resend failed SMS for campaign #{id} - {title}\n\n", $c->getAttributes()), Console::FG_GREEN);
			$cid = $c->id;
			// Kiem tra thoi gian gui tin...
			$lastMsg = Sent::find()->where(['campaign_id' => $cid])->orderBy(['time' => SORT_DESC])->one();
			if ($lastMsg){
				$time = $lastMsg->time;
				if ($campaignId || ($time > $now)){
					$inserted = Sent::getDb()->createCommand("
							INSERT INTO
								send_sms (
									momt, sender, receiver, msgdata, sms_type, coding, charset, campaign_id, dlr_mask, smsc_id
								) SELECT
									momt, sender, receiver, msgdata, sms_type, coding, charset, campaign_id, dlr_mask, smsc_id
							FROM sent_sms
								WHERE dlr=:dlr AND campaign_id=:cid",
					[':dlr' => 0, ':cid' => $cid])->execute();
					$deleted = Sent::getDb()->createCommand("
						DELETE FROM sent_sms WHERE dlr=:dlr AND campaign_id=:cid",
					[':dlr' => 0, ':cid' => $cid])->execute();
					Sent::getDb()->createCommand("
						UPDATE campaign SET finished=0, blocksent=NULL, sent=NULL WHERE id=:cid",
					[':cid' => $cid])->execute();

					echo $this->ansiFormat(Yii::t('sms', "Re-queue {num} of SMS to resend!\n\n", ['num' => $inserted]), Console::FG_RED );
				}
			}
		}
	}

	/**
	 * Refill the statistic information for campaign.
	 *
	 * If campaign ID is specified, the stats information will be triggered to that campaign.
	 * If not, all campaign run in 3 days interval will be run.
	 * @param string $campaignID The campaign ID need to stats
	 */
	public function actionStats($campaignID = null){
		$condition = ($campaignID)?['id' => $campaignID]:'start > DATE_SUB(NOW(), INTERVAL 3 DAY)';
		$cmd = Campaign::updateAll(['sent' => null, 'blocksent' => null], $condition);
		$campaigns = Campaign::findAll($condition);
		foreach ($campaigns as $cp){
			print $this->ansiFormat(Yii::t('sms', "Campaign #{id} - {title} has sent {sent} => {blocksent} messages.\n\n", [
					'id' => $cp->id,
					'title' => $cp->title,
					'sent' => $cp->getSent(),
					'blocksent' => $cp->getBlocksent(),
			]), Console::FG_RED);
		}
	}

}
