<?php
require_once "core/init.php";

use Config\Config;
use DB\DB;
use TableRows\TableRows;
use Auth\Auth;
use Chats\Chats;

$bazaSingleton=DB::getInstance(Config::get('baza'));

$bazaSingleton->getConnection();

if (isset($_SESSION["username"])) {
	foreach(new TableRows(new RecursiveArrayIterator($bazaSingleton->getChats())) as $k=>$v) {
		echo $v;
	}
	$chats=new Chats;
	echo $chats->getInputs();
}else{
	$logiranje=new Auth();
	echo $logiranje->getInputs();
}

if(isset($_POST['posalji'])){
	$last_id=$_POST['last_id'];
	$text=$_POST['text'];
	$bazaSingleton->createTask($last_id, $text);
	$bazaSingleton->BackToLanding();
}

if(isset($_POST['posalji_username'])){
	$username=$_POST['username'];
	$bazaSingleton->AuthenticateUser($username);
	$bazaSingleton->BackToLanding();
}

if(isset($_POST['logout'])){
	session_unset();
	session_destroy();
	$bazaSingleton->BackToLanding();
}
?>