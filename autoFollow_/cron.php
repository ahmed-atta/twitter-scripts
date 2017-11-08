<?php

require_once("config.php"); 
require("lib/twitter/twitteroauth.php");

//=====================================================//
$row = $mysqli->query("SELECT users.id as Uid,users.*,follows.id as fid,follows.* FROM follows,users 
					   WHERE follows.user_id = users.id
					   AND follows.timestamp > (NOW() - INTERVAL follows.unfollow DAY) ");
	while($user = $row->fetch_assoc()){
					$accessToken = $user['accessToken'];
					$accessTokenSecret =$user['accessTokenSecret'];

					 $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
					 $account = strip_tags($user['account_f']);
		
				
		
					if(!empty($user['next_cursor']) && $user['next_cursor'] != 0){
						 $followersList = $twitter->get('followers/list', array('screen_name' => $account, 'count'=>$user['f_count'],'skip_status'=>1,'cursor'=>$user['next_cursor'],
																		   'include_user_entities'=>false));
					}else {
						$followersList = $twitter->get('followers/list', array('screen_name' => $account, 'count'=>$user['f_count'],'skip_status'=>1,
																		   'include_user_entities'=>false));
					}
					//print_r($followersList->users[0]);
					//exit;
					 
					foreach($followersList->users as $k=>$follower){
						$isfollow = $twitter->get('friendships/show', array('source_screen_name' => $user['screen_name'], 'target_screen_name' => $follower->screen_name)); 
						if(!$isfollow->relationship->source->following){
									$twitter->post('friendships/create', array('screen_name' => $follower->screen_name));  
						}

					}
		$f1=  $mysqli->query("UPDATE `follows` SET `next_cursor` = '".$followersList->next_cursor_str."',
		`previous_cursor`='".$followersList->previous_cursor_str."' WHERE  id = ".$user['fid']);
		
		$friends = $twitter->get('account/verify_credentials',array('include_entities'=>false,'skip_status'=>true));
		$f2=  $mysqli->query("UPDATE `users` SET `friends_count_n` = '".$friends->friends_count."' WHERE  id = ".$user['Uid']);
		
	}

?>