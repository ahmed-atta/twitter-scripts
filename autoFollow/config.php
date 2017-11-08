<?php
/**
 * @file
 * A single location to store configuration. https://dev.twitter.com/apps
 */
define('CONSUMER_KEY', 'ddJKlh0vxSxcT67S3wr9JwmAW');
define('CONSUMER_SECRET', 'fvCND2dNw4XoKu0LLgTes4daQsF8W9ChGsTNC2Gai2UMSG3ilo');
define('OAUTH_CALLBACK', 'http://127.0.0.1/twitter/DEMOS/autoFollow/callback.php');
define('ACCESS_TOKEN',"3082363369-W4QSxDtYZbAo66BZhhBX2MCgRrk46mzbm3L5mtc");
define('TOKEN_SECRET',"S1IRKfPQtafaj3dNggbSY0sgKroT0yaHkjuPSZajpFUeL");

$Admin = "admin";
$Password = "123456";
// =====================================================================================//
/**
* Database settings
* 
**/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // مستخدم القاعدة
define('DB_PASSWORD', 'password'); // كلمة المرور
define('DB_DATABASE', 'demos_autofollow'); // اسم القاعدة

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

?>
