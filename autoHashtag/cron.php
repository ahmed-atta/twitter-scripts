<?php

require_once("config.php"); 
require_once('lib/twitter/twitteroauth.php');
//=====================================================//
$tq = "SELECT * FROM `tweets`";
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
				$txtwi = $tweet['tweet']."\r\n".$tweet['count'];
				$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
				if($txtwi){
						switch($tweet['hashtag_location']){
							case 'sa': 
								$woeid = "23424938";
								break;
							case 'eg':
								$woeid = "23424802";
								break;
							case 'kw':
								$woeid = "23424870"; 
								break;
							case 'ae':
								$woeid = "23424738"; 
								break;
							case 'qa':
								$woeid = "23424930"; 
								break;
							case 'bh':
								$woeid = "23424753"; 
								break;
							default:
						}
						$hashtags = $twitter->get('trends/place',array("id"=> $woeid));
						$hashs  ="\n";
					}
					$tweet_length = mb_strlen($txtwi, 'UTF-8');
					$hashs_ln = 140 - $tweet_length;  // Hashtags Length
					for($i = 0; $i < 10; $i++){
						$temp = $hashs .' '.$hashtags[0]->trends[$i]->name;
							if(mb_strlen($temp, 'UTF-8') < $hashs_ln)
								$hashs .=' '.$hashtags[0]->trends[$i]->name;
							else 
								break;	
					}
					$txtwi .= $hashs;
				
				$oksend = $twitter->post('statuses/update',array('status' =>$txtwi));
						$count = $tweet['count']+1;
						$mysqli->query("Update `tweets` SET count =".$count." WHERE id= ".$tweet['id']);

			}
		}
	}
}
?>