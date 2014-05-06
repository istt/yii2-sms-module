<?php

namespace istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\sms\models\Filter;

/**
 * FilterSearch represents the model behind the search form about `istt\sms\models\Filter`.
 */
class FilterSearch extends Filter
{
    public function rules()
    {
        return [
            [['id', 'ftpblack', 'ftpwhite'], 'integer'],
            [['title', 'reply_refuse', 'reply_accept', 'reply_false_syntax', 'description', 'ftpblackfile', 'ftpwhitefile', 'reply_accept_dup', 'reply_refuse_dup'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Filter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ftpblack' => $this->ftpblack,
            'ftpwhite' => $this->ftpwhite,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'reply_refuse', $this->reply_refuse])
            ->andFilterWhere(['like', 'reply_accept', $this->reply_accept])
            ->andFilterWhere(['like', 'reply_false_syntax', $this->reply_false_syntax])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'ftpblackfile', $this->ftpblackfile])
            ->andFilterWhere(['like', 'ftpwhitefile', $this->ftpwhitefile])
            ->andFilterWhere(['like', 'reply_accept_dup', $this->reply_accept_dup])
            ->andFilterWhere(['like', 'reply_refuse_dup', $this->reply_refuse_dup]);

        return $dataProvider;
    }
}
