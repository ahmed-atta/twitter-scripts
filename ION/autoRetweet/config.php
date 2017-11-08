<?php
/** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
//==============     =================== //
define('CONSUMER_KEY', "xxxxxxxxxxx"); 
define('CONSUMER_SECRET', "xxxxxxxxxxxxxxxxxxxx"); 
define('OAUTH_CALLBACK', "http://xxxxxxxxxxxxx/callback.php"); 
define('ACCESS_TOKEN',"xxxxxxxxxxxxxxxxxxxx"); 
define('TOKEN_SECRET',"xxxxxxxxxxxxxxxxxxxxxxxxxxxx");  

//================   ================ //
$R76DC4C449E8F2CF53739F99E73D8A052 = "admin"; 
$RD7F4A57E4625789A38C3C3DC44E8355B = "123456"; 
 
 
//================   ================ //
define('DB_SERVER', 'localhost'); 
define('DB_USERNAME', '');  
define('DB_PASSWORD', '');  
define('DB_DATABASE', '');    
//===================================================//

$R0DADB0D8CA9669A3F9F73A406CB0A0FC = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);   if ($R0DADB0D8CA9669A3F9F73A406CB0A0FC->connect_error) {     die('Connect Error (' . $R0DADB0D8CA9669A3F9F73A406CB0A0FC->connect_errno . ') ' . $R0DADB0D8CA9669A3F9F73A406CB0A0FC->connect_error); } else {   $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SET NAMES 'utf8'"); }
//============================================
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
?>