<?php

namespace vendor\istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\istt\sms\models\Mailbox;

/**
 * MailboxSearch represents the model behind the search form about `vendor\istt\sms\models\Mailbox`.
 */
class MailboxSearch extends Mailbox
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['hostname', 'email', 'password', 'option'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Mailbox::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'option', $this->option]);

        return $dataProvider;
    }
}
