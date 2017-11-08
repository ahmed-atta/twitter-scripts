<?php
/**
 * @file
 * A single location to store configuration. https://dev.twitter.com/apps
 */
define('CONSUMER_KEY', 'QlAZO0mmViITPBW9YpyiVuf9Z');
define('CONSUMER_SECRET', '042vyytWeVeoDpmQCyeFrIxWRvvohxVedTqn4jnWDTmCIjALoV');
define('OAUTH_CALLBACK', 'http://127.0.0.1/_demos/twitter/DEMOS/autoTweet/callback.php');
define('ACCESS_TOKEN',"1613669227-K8KyxFpBtsS4XxE7aSxL1ahsVOyzTIHQINSpDJz");
define('TOKEN_SECRET',"3rsMnx92G8wu4eyllhckwAIKdQAoTlHFWlllFaNG7sSgz");

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
define('DB_DATABASE', 'cdemos_autoretweet'); // اسم القاعدة

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
