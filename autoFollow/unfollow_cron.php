<?php

require_once("config.php"); 
require("lib/twitter/twitteroauth.php");

//=====================================================//
$row = $mysqli->query("SELECT users.*,users.id as Uid,follows.id as fid FROM follows,users 
					   WHERE follows.user_id = users.id
					   AND follows.timestamp < (NOW() - INTERVAL follows.unfollow DAY) ");
	while($user = $row->fetch_assoc()){
					$accessToken = $user['accessToken'];
					$accessTokenSecret =$user['accessTokenSecret'];

					 $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
									
					$followersList = $twitter->get('friends/list', array('screen_name' => $user['screen_name'], 'count'=>10,'skip_status'=>1,
																		   'include_user_entities'=>false));
					
					//print_r($followersList->users[0]);
					//exit;
					 
					foreach($followersList->users as $k=>$follower){
						$isfollow = $twitter->post('friendships/destroy', array('screen_name' => $follower->screen_name)); 

					}
		$friends = $twitter->get('account/verify_credentials',array('include_entities'=>false,'skip_status'=>true));
		$f2=  $mysqli->query("UPDATE `users` SET `friends_count_n` = '".$friends->friends_count."' ,
		`friends_count` ='".$friends->friends_count."'  WHERE  id = ".$user['Uid']);
		
		if($friends->friends_count < 5){
			$f1=  $mysqli->query("UPDATE `follows` SET `next_cursor` = '',`previous_cursor`='',`timestamp` = NOW()  WHERE  id = ".$user['fid']);
		}
		
	}

?>