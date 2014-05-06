<?php

namespace istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\sms\models\Ftp;

/**
 * FtpSearch represents the model behind the search form about `istt\sms\models\Ftp`.
 */
class FtpSearch extends Ftp
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'description', 'hostname', 'username', 'password', 'path'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Ftp::find();

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
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
