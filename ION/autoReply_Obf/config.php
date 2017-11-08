<?php
/** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
//==============   مفاتيح تطبيق تويتر  =================== //
define('CONSUMER_KEY', 'xxxxxxxxxxxxxxxxxx'); 
define('CONSUMER_SECRET', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); 
define('OAUTH_CALLBACK', 'http://xxxxxxxxxxxxxx/callback.php'); 
define('ACCESS_TOKEN',"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"); 
define('TOKEN_SECRET',"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");  

//================ بيانات المدير  ================ //
$R76DC4C449E8F2CF53739F99E73D8A052 = "admin"; 
$RD7F4A57E4625789A38C3C3DC44E8355B = "123456"; 
 
//================ قاعدة البيانات  ================ //
 define('DB_SERVER', 'localhost'); 
 define('DB_USERNAME', 'root');  
 define('DB_PASSWORD', 'password');  
 define('DB_DATABASE', 'cdemos_retweet'); 
//===================================================//

 $R0DADB0D8CA9669A3F9F73A406CB0A0FC = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);   if ($R0DADB0D8CA9669A3F9F73A406CB0A0FC->connect_error) {     die('Connect Error (' . $R0DADB0D8CA9669A3F9F73A406CB0A0FC->connect_errno . ') ' . $R0DADB0D8CA9669A3F9F73A406CB0A0FC->connect_error); } else {   $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SET NAMES 'utf8'"); }  ?>