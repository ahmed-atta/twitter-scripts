<?php 
session_start();
if($_SESSION['retweet_admin'] == 1) {
 
	require_once('config.php');
	$result1 = $mysqli->query("DELETE FROM `re_log` WHERE 1;");
	$result2 = $mysqli->query("ALTER TABLE `re_log` AUTO_INCREMENT = 1");
	$result3 = $mysqli->query("DELETE FROM `re_temp` WHERE 1;");
	$result4 = $mysqli->query("ALTER TABLE `re_temp` AUTO_INCREMENT = 1");

}
?>