<?php

namespace vendor\istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\istt\sms\models\Sms;

/**
 * SmsSearch represents the model behind the search form about `vendor\istt\sms\models\Sms`.
 */
class SmsSearch extends Sms
{
    public function rules()
    {
        return [
            [['momt', 'sender', 'receiver', 'udhdata', 'msgdata', 'time', 'smsc_id', 'service', 'account', 'dlr_url', 'charset', 'boxc_id', 'binfo', 'meta_data'], 'safe'],
            [['id', 'sms_type', 'mclass', 'mwi', 'coding', 'compress', 'validity', 'deferred', 'dlr_mask', 'pid', 'alt_dcs', 'rpi', 'campaign_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Sms::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'time' => $this->time,
            'id' => $this->id,
            'sms_type' => $this->sms_type,
            'mclass' => $this->mclass,
            'mwi' => $this->mwi,
            'coding' => $this->coding,
            'compress' => $this->compress,
            'validity' => $this->validity,
            'deferred' => $this->deferred,
            'dlr_mask' => $this->dlr_mask,
            'pid' => $this->pid,
            'alt_dcs' => $this->alt_dcs,
            'rpi' => $this->rpi,
            'campaign_id' => $this->campaign_id,
        ]);

        $query->andFilterWhere(['like', 'momt', $this->momt])
            ->andFilterWhere(['like', 'sender', $this->sender])
            ->andFilterWhere(['like', 'receiver', $this->receiver])
            ->andFilterWhere(['like', 'udhdata', $this->udhdata])
            ->andFilterWhere(['like', 'msgdata', $this->msgdata])
            ->andFilterWhere(['like', 'smsc_id', $this->smsc_id])
            ->andFilterWhere(['like', 'service', $this->service])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'dlr_url', $this->dlr_url])
            ->andFilterWhere(['like', 'charset', $this->charset])
            ->andFilterWhere(['like', 'boxc_id', $this->boxc_id])
            ->andFilterWhere(['like', 'binfo', $this->binfo])
            ->andFilterWhere(['like', 'meta_data', $this->meta_data]);

        return $dataProvider;
    }
}
