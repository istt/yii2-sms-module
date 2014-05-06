<?php

namespace vendor\istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\istt\sms\models\Blacklist;

/**
 * BlacklistSearch represents the model behind the search form about `vendor\istt\sms\models\Blacklist`.
 */
class BlacklistSearch extends Blacklist
{
    public function rules()
    {
        return [
            [['fid'], 'integer'],
            [['isdn'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Blacklist::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fid' => $this->fid,
        ]);

        $query->andFilterWhere(['like', 'isdn', $this->isdn]);

        return $dataProvider;
    }
}
