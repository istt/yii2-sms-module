<?php

namespace istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\sms\models\User;

/**
 * UserSearch represents the model behind the search form about `istt\sms\models\User`.
 */
class UserSearch extends User
{
    public function rules()
    {
        return [
            [['id', 'createtime', 'lastvisit', 'status', 'org'], 'integer'],
            [['username', 'password', 'email', 'activkey', 'sender', 'smsprefix'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'createtime' => $this->createtime,
            'lastvisit' => $this->lastvisit,
            'status' => $this->status,
            'org' => $this->org,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'activkey', $this->activkey])
            ->andFilterWhere(['like', 'sender', $this->sender])
            ->andFilterWhere(['like', 'smsprefix', $this->smsprefix]);

        return $dataProvider;
    }
}
