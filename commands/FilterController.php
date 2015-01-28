<?php

/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace istt\sms\commands;

use Yii;
use yii\console\Controller;
use istt\sms\models\Filter;
use istt\sms\models\Sent;
use istt\sms\models\Sms;
use yii\helpers\Console;
use Behat\Transliterator\Transliterator;
use istt\sms\models\Blacklist;
use istt\sms\models\Whitelist;

/**
 * Related Tasks on Filters
 *
 * @package console\controllers
 * @author Nguyen Dinh Trung <ndtrung@istt.com.vn>
 */
class FilterController extends Controller {

	/**
	 * Delete all send_sms and sent_sms older than 90 days
	 *
	 * Export filter data into zip file for later references
	 *
	 * @param string $campaignID
	 */
	public function actionExport($args = null) {
		Sent::deleteAll ( 'time < DATE_SUB(NOW(), INTERVAL 90 DAY)' );
		Sms::deleteAll ( 'time < DATE_SUB(NOW(), INTERVAL 90 DAY)' );

		if ($args)
			$filters = Filter::findAll ( $args );
		else
			$filters = Filter::find ()->all ();

		foreach ( $filters as $filter ) {
			echo $this->ansiFormat ( Yii::t ( 'sms', "Processing filter #{id} - {title}....\n", [
					'id' => $filter->primaryKey,
					'title' => $filter->title
			] ), Console::FG_GREEN );
			$this->exportTextFile ( $filter->title, $filter->primaryKey );
			echo $this->ansiFormat ( Yii::t ( 'sms', "Done process #{id} - {title}\n\n", [
					'id' => $filter->primaryKey,
					'title' => $filter->title
			] ), Console::FG_GREEN );
		}
	}

	// Dump the file into CSV file...
	function exportTextFile($filename, $fid) {
		$prefix = trim ( Transliterator::urlize ( $filename, '-' ) );
		$date = date ( 'Ymd', time () );
		$query = "SELECT isdn INTO OUTFILE ':outfile' LINES TERMINATED BY '\\n' FROM :table WHERE fid=:fid";

		$outfile = '/tmp/' . $date . '.isms.' . $prefix . '.dk.txt';
		@unlink ( $outfile );
		$cmd = Filter::getDb ()->createCommand ( strtr ( $query, array (
				':outfile' => $outfile,
				':table' => 'whitelist',
				':fid' => $fid,
				':date' => $date
		) ) );
		$rownum = $cmd->execute ();
		echo $this->ansiFormat ( Yii::t ( 'app', "Done export file {out} for filter #{id}. \n{rownum} rows exported!\n\n", [
				'id' => $fid,
				'out' => $outfile,
				'rownum' => $rownum
		] ), Console::FG_GREEN );
		@exec ( "gzip $outfile" );

		$outfile = '/tmp/' . $date . '.isms.' . $prefix . '.tc.txt';
		@unlink ( $outfile );
		$cmd = Filter::getDb ()->createCommand ( strtr ( $query, array (
				':outfile' => $outfile,
				':table' => 'blacklist',
				':fid' => $fid,
				':date' => $date
		) ) );
		$rownum = $cmd->execute ();
		echo $this->ansiFormat ( Yii::t ( 'app', "Done export file {out} for filter #{id}.\n {rownum} rows exported!\n\n", [
				'id' => $fid,
				'out' => $outfile,
				'rownum' => $rownum
		] ), Console::FG_GREEN );
		@exec ( "gzip $outfile" );
	}
	/**
	 * Import data for a specified Filter
	 * @param unknown $args
	 */
	public function actionImport($args) {
		// $args gives an array of the command-line arguments for this command
		if (! empty ( $args )) {
			$filters = Filter::findAll ( $args );
		} else {
			$filters = Filter::findAll ( 'ftpblack IS NOT NULL OR ftpwhite IS NOT NULL' );
		}
		$blacklistFiles = $blacklistRemoved = [ ];
		$whitelistFiles = $whitelistRemoved = [ ];
		foreach ( $filters as $filter ) {
			echo $this->ansiFormat ( Yii::t ( 'sms', "Processing filter #{id} - {title}", [
					'id' => $filter->id,
					'title' => $filter->title
			] ), Console::FG_GREEN );
			try {
				if (is_object ( $filter->ftpblacklist )) {
					$blackFile = strftime ( $filter->ftpblackfile );
					$blackUrl = $filter->ftpblacklist->getUrl () . $blackFile;
					$directory = $filter->getDirectory ();
					$blacklistFiles [$this->downloadFilterFtpFiles ( $blackUrl, $blackFile, $directory )] = $filter->id;
					$blacklistRemoved [$filter->id] = TRUE;
				}
			} catch ( CException $e ) {
				$this->log ( 'info', 'Got error: ' . $e->getMessage () );
			}
			try {
				if (is_object ( $filter->ftpwhitelist )) {
					$whiteFile = strftime ( $filter->ftpwhitefile );
					$whiteUrl = $filter->ftpwhitelist->getUrl () . $whiteFile;
					$directory = $filter->getDirectory ();
					$whitelistFiles [$this->downloadFilterFtpFiles ( $whiteUrl, $whiteFile, $directory )] = $filter->getPrimaryKey ();
					$whitelistRemoved [$filter->getPrimaryKey ()] = TRUE;
				}
			} catch ( CException $e ) {
				echo $this->ansiFormat(Yii::t('sms', 'Got Error: {error}', ['error' => $e->getMessage()]), Console::FG_RED);
			}
		}
		Blacklist::deleteAll(['in', 'fid', $blacklistRemoved]);
		Whitelist::deleteAll(['in', 'fid', $whitelistRemoved]);

		foreach ( $blacklistFiles as $infile => $fid ){
			$this->importDatafile ( $infile, $fid, 'blacklist' );
		}
		foreach ( $whitelistFiles as $infile => $fid ){
			$this->importDatafile ( $infile, $fid, 'whitelist' );
		}
	}

	/**
	 * Main function to retrieve files from FTP
	 */
	public function downloadFilterFtpFiles($ftpurl, $filename, $directory) {
		$destination = $directory . DIRECTORY_SEPARATOR . $filename;
		if (file_exists ( $destination )) {
			$pos = strrpos ( $filename, '.' );
			if ($pos !== FALSE) {
				$name = substr ( $filename, 0, $pos );
				$ext = substr ( $filename, $pos );
			} else {
				$name = $filename;
				$ext = '';
			}

			$counter = 0;
			do {
				$destination = $directory . DIRECTORY_SEPARATOR . $name . '_' . $counter ++ . $ext;
			} while ( file_exists ( $destination ) );
		}

		$this->log ( 'info', 'Download URL: [ :ftpurl ] to [:destination]', array (
				':ftpurl' => $ftpurl,
				':destination' => $destination
		) );

		DirectoryHelper::safe_directory ( dirname ( $destination ) );

		$res = exec ( "wget -q $ftpurl -O $destination" );
		if ($res == 0)
			return $destination;

		$ch = curl_init ( $ftpurl );
		if (! ($fh = fopen ( $destination, 'w' ))) {
			echo $this->ansiFormat('Failed to create new file [:dest]', array (
					':dest' => $destination
			) );
		} else {
			curl_setopt ( $ch, CURLOPT_FILE, $fh );
			if (curl_exec ( $ch ) === FALSE) {
				echo $this->ansiFormat ( "Could not get the file :name", array (
						':name' => $filename
				) );
				fclose ( $fh );
				@unlink ( $destination );
			} else {
				echo $this->ansiFormat ( "Successfully download file :name ", array (
						':name' => $filename
				) );
				curl_close ( $ch );
				fclose ( $fh );
				return $destination;
			}
			curl_close ( $ch );
		}
	}
	function importTextFile($infile, $fid, $table) {
		$mv = TRUE;
		$datafile = escapeshellarg ( $infile );
		$cmd = escapeshellcmd ( "dos2unix $datafile" );
		system ( $cmd, $cmdout );
		$this->log ( 'info', "Command executed:\n:cmd\n\tOutput::out", array (
				':cmd' => $cmd,
				':out' => $cmdout
		) );

		// Stupid excel encoding....
		$cmd = "col -b < $datafile > /tmp/filterdata.txt 2>&1";
		system ( $cmd, $cmdout );
		if ($cmdout != 0) {
			echo $this->ansiFormat("Command executed:\n:cmd\n\tOutput::out", array (
					':cmd' => $cmd,
					':out' => $cmdout
			) );
			// Try again using iconv....
			$cmd = "iconv -f UTF-16 -t ASCII $datafile > /tmp/filterdata.txt 2>&1";
			system ( $cmd, $cmdout );

			if ($cmdout) { // error again???
				$mv = FALSE;
				echo $this->ansiFormat('There is no way I could convert this file: ' . $datafile, Console::FG_RED );
			} else {
				$this->log ( 'info', "Successfully convert using iconv:\n" . $cmd . "\n" );
			}
		}

		if ($mv) {
			$cmd = escapeshellcmd ( "mv /tmp/filterdata.txt $datafile" );
			system ( $cmd, $cmdout );
			$this->log ( 'info', "Command executed:\n:cmd\n\tOutput::out", array (
					':cmd' => $cmd,
					':out' => $cmdout
			) );
		}

		$query = 'LOAD DATA LOCAL INFILE \':infile\' REPLACE INTO TABLE :table
    		CHARACTER SET utf8
    		FIELDS TERMINATED BY "," OPTIONALLY ENCLOSED BY \'"\'
    		LINES TERMINATED BY "\n"
    		( @isdn ) SET
    		isdn=CAST(@isdn AS UNSIGNED),
    		fid=:fid';
		$cmd = Filter::getDb ()->createCommand ( strtr ( $query, array (
				':infile' => $infile,
				':fid' => $fid,
				':table' => $table
		) ) );
		$numrow = $cmd->execute ();
		echo $this->ansiFormat ( Yii::t ( 'app', "Done import file !file.\n{numrow} rows imported.\n\n", [
				'!file' => $infile,
				'numrow' => $numrow
		] ), Console::FG_GREEN );
	}

	/**
	 * Function to import CSV file
	 */
	function importDatafile($infile, $fid, $table) {
		if (! file_exists ( $infile ))
			return;

		$mime = CFileHelper::getMimeType ( $infile );
		if ((in_array ( $mime, $this->textMimeTypes )) or (in_array ( $mime, $this->csvMimeTypes ))) {
			$this->importTextFile ( $infile, $fid, $table );
		} /**
		 * ZIP files
		 */
		elseif (in_array ( $mime, $this->zipMimeTypes )) {
			$this->log ( 'info', "Processing ZIP file :zip for filter [:id]", array (
					':zip' => $infile,
					':id' => $fid
			) );
			if (! empty ( $infile )) {
				$basename = pathinfo ( $infile, PATHINFO_FILENAME );
				$dest = pathinfo ( $infile, PATHINFO_DIRNAME );
				$zip = new EZip ();
				$zip->extractZip ( $infile, $dest );
				$zipfiles = $zip->lsZip ( $infile );
				foreach ( $zipfiles as $filename ) {
					$this->importDatafile ( $dest . DIRECTORY_SEPARATOR . $filename, $fid, $table );
				}
			}
		} else {
			$this->log ( 'info', "Cannot proccess file :file with mime :mime", array (
					':file' => $infile,
					':mime' => $mime
			) );
		}
		@unlink ( $infile );
	}

	/**
	 * Generate dummy data for Filter
	 *
	 * @param number $cnt
	 *        	Number of filter to generate
	 */
	public function actionDummy($cnt = 10) {
		$lastFilter = Filter::find ()->orderBy ( [
				'id' => SORT_DESC
		] )->one ();
		$maxId = 0;
		if ($lastFilter) {
			$maxId += $lastFilter->id;
		}
		$success = 0;
		for($i = $maxId; $i < $maxId + $cnt; $i ++) {
			$filter = new Filter ();
			$filter->title = "Dummy Filter #" . $i;
			$filter->description = "A short description for dummy filter #" . $i;
			if ($filter->save ()) {
				$success ++;
			} else {
				var_dump ( $filter->errors );
			}
		}
		echo "Successfully create $success filter";
	}
}
