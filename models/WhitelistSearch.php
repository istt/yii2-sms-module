<?php

namespace istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\sms\models\Whitelist;

/**
 * WhitelistSearch represents the model behind the search form about `istt\sms\models\Whitelist`.
 */
class WhitelistSearch extends Whitelist
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
        $query = Whitelist::find();

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
