<?php

namespace istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\sms\models\Template;

/**
 * TemplateSearch represents the model behind the search form about `istt\sms\models\Template`.
 */
class TemplateSearch extends Template
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'body'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Template::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }
}
