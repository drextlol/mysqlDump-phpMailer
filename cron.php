<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('max_execution_time', 3600);

	include_once("vendor/ifsnop/mysqldump-php/src/Ifsnop/Mysqldump/Mysqldump.php");
	include('smtpMail.php');

	use Ifsnop\Mysqldump as IMysqldump;
	date_default_timezone_set('America/Sao_Paulo');
	$dt = new DateTime('now');
	$sendMail = new sendMail();
	$mailOption = array();

	try {
	    $dump = new IMysqldump\Mysqldump('database_name', 'database_user', 'database_pass', 'database_host', 'database_type');
	    if(!is_dir('storage')){
			mkdir("storage");
		}

		$timeName =  "dump_" . $dt->format('dmY_His');
		$storageName = 'storage/' . $timeName . '.sql';
	    $dump->start($storageName);

	    $mailOption['return'] = "MySqlDump sucesso";
	    $mailOption['content'] = "Backup de banco de dados efetuado com sucesso, arquivo: ". $storageName ."";

	    $sendMail->options($mailOption);

	} catch (\Exception $e) {
		$mailOption['return'] = 'MySqlDump error';
		$mailOption['content'] = $e->getMessage();
		
		$sendMail->options($mailOption);
	}

?>