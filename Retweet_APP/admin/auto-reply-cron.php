<?php

require_once("config.php"); 
require("lib/twitter/twitteroauth.php");

function tweetExits($mysqli,$tweet_id,$user_id){
	$tID = $mysqli->query("SELECT id  FROM `re_reply_logs` WHERE tweetID ='$tweet_id' AND user_id ='$user_id'");
	if($tID && ($tID->num_rows > 0)){
		return true;
	} else if(isset($tweet_id) && !empty($tweet_id)){
		$tID = $mysqli->query("INSERT INTO `re_reply_logs` (tweetID,user_id) VALUES ('$tweet_id','$user_id');");
		return false;
	}
	return false;
 }
//=====================================================
$uq = "SELECT U.id AS id,
U.accessToken AS accessToken,
U.accessTokenSecret AS accessTokenSecret,
RP.tweet as tweet ,
RP.count as count,
RP.id as RID,
RP.screen_name as screen_name  
FROM `re_users` AS U 
INNER JOIN `re_replies` AS RP ON U.id = RP.user_id";
$users = $mysqli->query($uq);
while($user = $users->fetch_assoc()) {
			$consumerKey = CONSUMER_KEY;
			$consumerSecret = CONSUMER_SECRET;
			$twitter = new TwitterOAuth($consumerKey, $consumerSecret, $user['accessToken'], $user['accessTokenSecret']);
			$posts = $twitter->get('statuses/user_timeline', array('screen_name' => $user['screen_name'],'count' =>1,'trim_user'=>1,
			'exclude_replies'=>true,'include_rts'=> false));
			foreach($posts as $k=>$post){
				if(!tweetExits($mysqli,$post->id_str,$user['id'])){
					$twitter->post('statuses/update',array('status'=>$user['tweet']." @".$user['screen_name']."\r\n".$user['count'],'in_reply_to_status_id'=>$post->id_str)) ;
					$count = $user['count'] + 1 ;
					$tID = $mysqli->query("UPDATE `re_replies` SET `count` = $count  WHERE id = ".$user['RID']);
				}
			}	
		}
		
			

exit;
?>