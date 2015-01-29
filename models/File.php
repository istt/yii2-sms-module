<?php

namespace istt\sms\models;

use Yii;
use yii\helpers\FileHelper;

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
    const STATUS_REMOVED = 0;
    const STATUS_EXISTS = 1;
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['status'], 'in', 'range' => [self::STATUS_REMOVED, self::STATUS_EXISTS]],
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

    /**
     * Run after validate()
     */
    private function getBasePath(){
    	$path = Yii::getAlias("@web/uploads/campaigns");
    	FileHelper::createDirectory($path, 0755, true);
   		return $path;
    }
    public function fileUri2Path($uri = null){
    	if (empty($uri)) $uri = $this->uri;
    	return str_replace('public://', $this->getBasePath(), $uri);
    }
    public function filePath2Uri($path = null){
    	if (empty($path)) $path = $this->filepath;
    	return str_replace($this->getBasePath(), 'public://', $path);
    }
    public function getDownload($path = null){
    	if (empty($path)) $path = $this->filepath;
    	return  '<a href="'.Yii::app()->getBaseUrl() . str_replace(Yii::getPathOfAlias("application"), '/protected', $path) . '">'.$this->filename.'</a>' ;
    }
    public function fileProperties($path = null){
    	if (empty($path)) $path = $this->filepath;
    	$fileinfo = pathinfo($path);
    	if (empty($this->title)) $this->title = $fileinfo['basename'];
    	if (empty($this->description)) $this->description = $fileinfo['basename'];
    	$this->filename = $fileinfo['basename'];
    	$this->filesize = filesize($path);
    	$this->filemime = FileHelper::getMimeType($path);
    	$this->uri = $this->filePath2Uri($path);
    	$this->status = $this->getFileStatus($path);
    }

    public function getFileStatus($path = null){
    	if (empty($path)) $path = $this->filepath;
    	return ((file_exists($path))?(self::STATUS_EXISTS):(self::STATUS_REMOVED));
    }
    protected function afterFind() {
    	$this->filepath = $this->fileUri2Path();
    	$this->status = $this->getFileStatus();
    	if ($this->status == self::STATUS_REMOVED) $this->delete();
    	parent::afterFind();
    }
    /**
     * Set the file instance for this module.
     * @param CUploadedFile $file The uploaded file.
     * @param string $directory	The directory to save to.
     */
    public function setFileInstance(CUploadedFile $file, $directory = null) {
    	if (empty($directory)) {
    		$directory = $this->getBasePath();
    	} else $directory = DirectoryHelper::safe_directory($directory);
    	$this->fileInstance = $file;
    	$this->filepath = $directory . DIRECTORY_SEPARATOR . $file->getName();
    	$ext = $file->getExtensionName();
    	if ($ext)
    		$prefix = substr($this->filepath, 0, strpos($this->filepath, $ext));
    	else $prefix = $this->filepath;
    	$suffix = 0;
    	while (file_exists($this->filepath)) {
    		$this->filepath = $prefix . '_' . $suffix . '.' . $ext;
    		$suffix++;
    	}
    	$file->saveAs($this->filepath);
    	$this->filename = basename($this->filepath);
    	if (empty($this->title)) $this->title = $this->filename;
    	if (empty($this->description)) $this->description = $this->filename;
    	$this->filesize = $file->getSize();
    	$this->filemime = $file->getType();
    	$this->uri = $this->filePath2Uri();
    	$this->status = $this->getFileStatus();
    }
    /**
     * Helper functions for options
     */
    const STATUS_REMOVED = 0;
    const STATUS_EXISTS = 1;
    public function beforeDelete(){
    	@unlink($this->fileUri2Path());
    	Cpfile::deleteAll(['fid' => $this->primaryKey]);
    	parent::beforeDelete();
    }
}
