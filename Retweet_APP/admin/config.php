<?php
/**
 * @file
 * A single location to store configuration. https://dev.twitter.com/apps
 */
define('CONSUMER_KEY', 'tn2usk2GIiPpfncfQATq0YF4v');
define('CONSUMER_SECRET', 'BW0DFJvrjPIm3OTFIvTNPQGSvi68v3mWV9hLUZRXsa0gwILxm2');
define('OAUTH_CALLBACK', 'http://abosheakh.com/admin/callback.php');
define('ACCESS_TOKEN',"2343394925-bLvJLsVrYRIJAddt1DFVQCM3MD7WoXQ5lEMg68U");
define('TOKEN_SECRET',"xCwEw4rkTRwRyezwbVEOKlVOuCG0FDAW1GnAI58LLwjSn");

$Admin = "admin";
$Password = "123456";
// =====================================================================================//
/**
* Database settings
* 
**/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'abo_twitter'); // مستخدم القاعدة
define('DB_PASSWORD', 'TwiTTer123'); // كلمة المرور
define('DB_DATABASE', 'abosheakh_twitter'); // اسم القاعدة

// ==================================================

$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die("فشل الاتصال بقاعدة البيانات");
$database = mysql_select_db(DB_DATABASE) or die("فشل الاتصال بقاعدة البيانات");
mysql_query("SET NAMES 'utf8'");

//======================================================  v1.1  MySQLi  ENGINE
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);

/*
 * This is the "official" OO way to do it,
 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
 *//* check connection */
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
} else {
  $mysqli->query("SET NAMES 'utf8'");
}
//============================================
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>