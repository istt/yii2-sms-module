<?php

namespace istt\sms\models;

use Yii;

/**
 * This is the model class for table "datafile".
 *
 * @property integer $fid
   * @property string $title
   * @property string $description
   * @property string $createtime
   * @property string $filename
   * @property string $uri
   * @property string $filemime
   * @property string $filesize
   * @property integer $status
   * @property string $updatetime
   * @property string $uid
   *
 * @property Cpfile $cpfile
 * @property Campaign[] $campaigns
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%datafile}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return ($db = Yii::$app->get('smsDb'))?$db:Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['createtime', 'filesize', 'status', 'updatetime', 'uid'], 'integer'],
            [['title', 'filename', 'uri', 'filemime'], 'string', 'max' => 255],
            [['uri'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fid' => Yii::t('sms', 'File ID.'),
            'title' => Yii::t('sms', 'Title'),
            'description' => Yii::t('sms', 'Description'),
            'createtime' => Yii::t('sms', 'The users.uid of the user who is associated with the file.'),
            'filename' => Yii::t('sms', 'Name of the file with no path components. This may differ from the basename of the URI if the file is renamed to avoid overwriting an existing file.'),
            'uri' => Yii::t('sms', 'The URI to access the file (either local or remote).'),
            'filemime' => Yii::t('sms', 'The file’s MIME type.'),
            'filesize' => Yii::t('sms', 'The size of the file in bytes.'),
            'status' => Yii::t('sms', 'A field indicating the status of the file. Two status are defined in core: temporary (0) and permanent (1). Temporary files older than DRUPAL_MAXIMUM_TEMP_FILE_AGE will be removed during a cron run.'),
            'updatetime' => Yii::t('sms', 'UNIX timestamp for when the file was added.'),
            'uid' => Yii::t('sms', 'Uid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpfile()
    {
        return $this->hasOne(Cpfile::className(), ['fid' => 'fid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::className(), ['id' => 'cid'])->viaTable(Cpfile::tableName(), ['fid' => 'fid']);
    }
}
