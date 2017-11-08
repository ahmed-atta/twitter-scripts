<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @website http://demos.parmagy.com/twitter
 */
 require("lib/twitter/twitteroauth.php");
 require('config.php');
 
 function tweetExits($mysqli,$tweet_id,$userID){
	$tID = $mysqli->query("SELECT id  FROM `re_log` WHERE tweetID ='$tweet_id' AND userID ='$userID'");
	if($tID && ($tID->num_rows > 0)){
		$mysqli->query("DELETE FROM `re_temp` WHERE tweetID =".$tweet_id);
		return true;
	} else {
		$tID = $mysqli->query("INSERT INTO `re_log` (tweetID,userID) VALUES ('$tweet_id',$userID);");
		return false;
	}
 }
 
 $tempID = $mysqli->query("SELECT *  FROM `re_temp`");
 if(mysqli_num_rows($tempID) > 0){
	while($tweet = $tempID->fetch_assoc()){
		$limit =(isset($tweet['counts']) && !empty($tweet['counts']))? "LIMIT 0 ,".$tweet['counts']:'';
		$users = $mysqli->query("SELECT U.id,U.accessToken, U.accessTokenSecret  FROM `re_users` AS U  ".$limit);
		if ($users) {
			while($user = $users->fetch_assoc()) {
				if(!tweetExits($mysqli,$tweet['tweetID'], $user["id"])){
					@$accessToken = $user["accessToken"];
					@$accessTokenSecret = $user["accessTokenSecret"];
					$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
					switch($tweet['type']){
						case 'RF': {
							$oksend = $twitter->post('favorites/create', array('id' => $tweet['tweetID']));
							$oksend = $twitter->post('statuses/retweet/'.$tweet['tweetID']);
						}
						break;
						case 'F':
						{
							$oksend = $twitter->post('favorites/create', array('id' => $tweet['tweetID']));
						}
						break;
						default :
						$oksend = $twitter->post('statuses/retweet/'.$tweet['tweetID']);
					}
				}
			}
			$mysqli->query("DELETE FROM `re_temp` WHERE id=".$tweet['id']);
		}
	}
 }


?>