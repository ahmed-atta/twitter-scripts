<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
 session_start(); if($_SESSION['retweet_admin'] == 1) {    require_once('config.php');  $RF07B03D1A3761D29C5B570AACE1DAC54 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("DELETE FROM `re_log` WHERE 1;");  $RBCAD8604F1365528276ACD3796428C41 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("ALTER TABLE `re_log` AUTO_INCREMENT = 1");  $R80CE8E544A3E57F7DEBC41BA4BEA8367 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("DELETE FROM `re_temp` WHERE 1;");  $R89B71A557863309789CD6E0DFC4E8E84 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("ALTER TABLE `re_temp` AUTO_INCREMENT = 1");  } ?>