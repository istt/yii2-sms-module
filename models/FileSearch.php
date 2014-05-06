<?php

namespace istt\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use istt\sms\models\File;

/**
 * FileSearch represents the model behind the search form about `istt\sms\models\File`.
 */
class FileSearch extends File
{
    public function rules()
    {
        return [
            [['fid', 'createtime', 'filesize', 'status', 'updatetime', 'uid'], 'integer'],
            [['title', 'description', 'filename', 'uri', 'filemime'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = File::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fid' => $this->fid,
            'createtime' => $this->createtime,
            'filesize' => $this->filesize,
            'status' => $this->status,
            'updatetime' => $this->updatetime,
            'uid' => $this->uid,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'uri', $this->uri])
            ->andFilterWhere(['like', 'filemime', $this->filemime]);

        return $dataProvider;
    }
}
