<?php

namespace istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\sms\models\Campaign;

/**
 * CampaignSearch represents the model behind the search form about `istt\sms\models\Campaign`.
 */
class CampaignSearch extends Campaign
{
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'status', 'finished', 'approved', 'active', 'ready', 'org', 'type', 'throughput', 'col', 'isdncol', 'priority', 'velocity', 'emailbox', 'ftpserver', 'smsimport', 'blockimport', 'limit_exceeded', 'send', 'blocksend', 'sent', 'blocksent', 'orderid', 'exported'], 'integer'],
            [['title', 'description', 'codename', 'request_date', 'request_owner', 'datasender', 'tosubscriber', 'start', 'end', 'sender', 'template', 'cpworkday', 'esubject', 'eattachment'], 'safe'],
        		// Extra complex properties
        		[['gridTitle', 'gridStatus', 'gridTime'], 'safe']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Campaign::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'request_date' => $this->request_date,
            'start' => $this->start,
            'end' => $this->end,
            'status' => $this->status,
            'finished' => $this->finished,
            'approved' => $this->approved,
            'active' => $this->active,
            'ready' => $this->ready,
            'org' => $this->org,
            'type' => $this->type,
            'throughput' => $this->throughput,
            'col' => $this->col,
            'isdncol' => $this->isdncol,
            'priority' => $this->priority,
            'velocity' => $this->velocity,
            'emailbox' => $this->emailbox,
            'ftpserver' => $this->ftpserver,
            'smsimport' => $this->smsimport,
            'blockimport' => $this->blockimport,
            'limit_exceeded' => $this->limit_exceeded,
            'send' => $this->send,
            'blocksend' => $this->blocksend,
            'sent' => $this->sent,
            'blocksent' => $this->blocksent,
            'orderid' => $this->orderid,
            'exported' => $this->exported,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'codename', $this->codename])
            ->andFilterWhere(['like', 'request_owner', $this->request_owner])
            ->andFilterWhere(['like', 'datasender', $this->datasender])
            ->andFilterWhere(['like', 'tosubscriber', $this->tosubscriber])
            ->andFilterWhere(['like', 'sender', $this->sender])
            ->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'cpworkday', $this->cpworkday])
            ->andFilterWhere(['like', 'esubject', $this->esubject])
            ->andFilterWhere(['like', 'eattachment', $this->eattachment]);

        // Extra properties for search
        if ($this->gridTitle){
        	$query->addFilterWhere(['or',
        			['like', 'title', $this->gridTitle],
        			['like', 'description', $this->gridTitle],
        			['like', 'codename', $this->gridTitle],
        			['like', 'template', $this->gridTitle],
        	]);
        }

        return $dataProvider;
    }
}
