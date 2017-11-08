<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
 session_start(); if(isset($_SESSION['retweet_admin']) &&  $_SESSION['retweet_admin'] === 1 && isset($_SESSION['admin_id']) ){  unset($_SESSION['retweet_admin']);  unset($_SESSION['admin_id']);   header("Location: index.php"); } else {  header("Location: index.php"); } ?>