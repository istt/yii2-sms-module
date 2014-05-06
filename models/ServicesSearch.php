<?php

namespace vendor\istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\istt\sms\models\Services;

/**
 * ServicesSearch represents the model behind the search form about `vendor\istt\sms\models\Services`.
 */
class ServicesSearch extends Services
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'password', 'sender'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Services::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'sender', $this->sender]);

        return $dataProvider;
    }
}
