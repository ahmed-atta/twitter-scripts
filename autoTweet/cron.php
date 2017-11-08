<?php

require_once("config.php"); 
require_once('lib/twitter/twitter.class.php');
$tws = 10; // عدد التغريدة في كل مرة
$_timezone = "+03:00";
//=====================================================//
$tq = "SELECT * FROM `tweets` WHERE last_access <= CONVERT_TZ( NOW(),'-07:00','".$_timezone."')  LIMIT ".$tws;
if($tweets = $mysqli->query($tq)){
	if($tweets->num_rows > 0){
		while($tweet = $tweets->fetch_assoc()) {
			if(isset($tweet['user_id']) && $tweet['user_id'] == '-1'){
				$users = $mysqli->query("SELECT * FROM users");
			} else if(isset($tweet['user_id']) && !empty($tweet['user_id'])){
				$users = $mysqli->query("SELECT * FROM users WHERE id IN (".$tweet['user_id'].");");
			} else {
				exit;
			}
			while($user = $users->fetch_assoc()) {
				$accessToken = $user['accessToken'];
				$accessTokenSecret = $user['accessTokenSecret'];
				$txtwi = ($tweet['loop'] == 1)? $tweet['tweet']."\r\n ".$tweet['count']: $tweet['tweet'];
				$twitter = new Twitter(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
				$oksend = $twitter->send($txtwi);
				 //if($oksend == 0) { //
					if($tweet['loop'] == 1){
						$count = $tweet['count']+1;
						$time =  strtotime("+".$tweet['interval']." seconds");
						$mysqli->query("Update `tweets` SET count =".$count.",last_access = CONVERT_TZ( NOW(),'-07:00','".$_timezone."')+INTERVAL ".$tweet['interval']." MINUTE  WHERE id= ".$tweet['id']);
					} else
						$rm_tweets = $mysqli->query("DELETE FROM `tweets` WHERE id= ".$tweet['id']);
			}
		}
	}
}
?>