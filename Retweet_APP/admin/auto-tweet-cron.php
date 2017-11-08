<?php
require_once("config.php"); 
require_once('lib/twitter/twitteroauth.php');
$_timezone ="+03:00";
if($qtz = $mysqli->query("SELECT  `option_value`  FROM  `re_options` WHERE  `option_name` =  'timezone'")){
	$rtz = $qtz->fetch_assoc();
	$_tz = $rtz['option_value'];
	$timezone = -1 * $_tz/60;
	$_timezone='';
	if($timezone < 0){
		$_timezone .= "-0".abs($timezone).":00";
	} else {
		$_timezone .= "+0".$timezone.":00";
	}
}

//=====================================================//
$tq = "SELECT * FROM `re_tweets` WHERE last_access <= CONVERT_TZ( NOW(),'-07:00','".$_timezone."') AND status = 0  LIMIT  1";
if($tweets = $mysqli->query($tq)){
	if($tweets->num_rows > 0){
		$users = $mysqli->query("SELECT * FROM `re_users` WHERE admin_id = 1");
		while($tweet = $tweets->fetch_assoc()) {
			while($user = $users->fetch_assoc()) {
				$accessToken = $user['accessToken'];
				$accessTokenSecret = $user['accessTokenSecret'];
				$txtwi = ($tweet['loop'] == 1)? $tweet['tweet']."\r\n".$tweet['count']: $tweet['tweet'];
				$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
				// ============= Set Hashtag 
				if($tweet['is_hashtag']){
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
				}
						$tweet_length = mb_strlen($txtwi, 'UTF-8');
						$hashs_ln = 140 - $tweet_length;  // Hashtags Length
						$hashs  ="\n";
						for($i = 0; $i < 10; $i++){
							$temp = $hashs .' '.$hashtags[0]->trends[$i]->name;
								if(mb_strlen($temp, 'UTF-8') < $hashs_ln)
									$hashs .=' '.$hashtags[0]->trends[$i]->name;
								else 
									break;	
						}
						$txtwi .= $hashs;
			}
				$oksend = $twitter->post('statuses/update',array('status' =>$txtwi));
				 //print_r($oksend); 
					if($tweet['loop'] == 1){
						$count = $tweet['count']+1;
						$time =  strtotime("+".$tweet['interval']." seconds");
						$mysqli->query("Update `re_tweets` SET count =".$count.",status = 1 ,last_access = CONVERT_TZ( NOW(),'-07:00','".$_timezone."')+INTERVAL ".$tweet['interval']." MINUTE  WHERE id= ".$tweet['id']);
					} else
						$rm_tweets = $mysqli->query("Update `re_tweets` SET status = 1 WHERE id= ".$tweet['id']);
		}
	}
}
?>