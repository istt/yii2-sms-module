<?php

namespace istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\sms\models\Worktime;

/**
 * WorktimeSearch represents the model behind the search form about `istt\sms\models\Worktime`.
 */
class WorktimeSearch extends Worktime
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['start', 'end'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Worktime::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
        ]);

        return $dataProvider;
    }
}
