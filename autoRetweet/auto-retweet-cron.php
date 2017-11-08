<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @website http://demos.parmagy.com/twitter
 */
 require("lib/twitter/twitteroauth.php");
 require('config.php');
 
 function tweetExits($mysqli,$tweet_id,$counts,$type){
	$tID = $mysqli->query("SELECT id  FROM `re_temp` WHERE tweetID ='$tweet_id'");
	if($tID && ($tID->num_rows > 0)){
		return true;
	} else if(isset($tweet_id) && !empty($tweet_id)){
		$counts =(!empty($counts))? $counts : 0;
		$tID = $mysqli->query("INSERT INTO `re_temp` (tweetID,counts,type) VALUES ('$tweet_id','$counts','$type');");
		return false;
	}
 }
 

 
 $rs_retweet = $mysqli->query("SELECT  *  FROM `re_auto` ");
 $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, TOKEN_SECRET);
 if(mysqli_num_rows($rs_retweet) > 0){
	while($row = $rs_retweet->fetch_assoc()){
		switch($row['forT']){
			case 'F':{
				$posts=$twitter->get('favorites/list', array('screen_name' => $row['twitter_account'],'count' => 3));
			}
			break;
			default :
			$posts = $twitter->get('statuses/user_timeline', array('screen_name' => $row['twitter_account'],'count' => 3,'trim_user'=>1,'exclude_replies'=>true,'include_rts'=> false));
		}
		foreach($posts as $k=>$post){
			echo tweetExits($mysqli,$post->id_str,$row['counts'],$row['type']);
		}	
	}
}
?>