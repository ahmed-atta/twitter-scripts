<?php
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
class User {

    function checkUser($mysqli,$uid, 
						$oauth_provider, 
						$username,$twitter_otoken,
						$twitter_otoken_secret,
						$access_token_oauth_token,
						$access_token_oauth_token_secret,
						$screen_name,
					  	$friends_count) 
	{
        $query = $mysqli->query("SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die($mysqli->error);
        $result = $query->fetch_array();
        if (!empty($result)) {
            # User is already present
          $query = $mysqli->query("UPDATE `users` SET `twitter_oauth_token` = '$twitter_otoken',
		  `twitter_oauth_token_secret` = '$twitter_otoken_secret',`accessToken` = '$access_token_oauth_token',`friends_count` = '$friends_count'
		  `accessTokenSecret` = '$access_token_oauth_token_secret' WHERE  oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die($mysqli->error);
        } else {
            #user not present. Insert a new Record
            $query = $mysqli->query("INSERT INTO `users` (oauth_provider, oauth_uid, username,twitter_oauth_token,twitter_oauth_token_secret,accessToken,
			accessTokenSecret,screen_name,friends_count)
			VALUES ('$oauth_provider', $uid, '$username','$twitter_otoken','$twitter_otoken_secret','$access_token_oauth_token',
			'$access_token_oauth_token_secret','$screen_name','$friends_count')") or die($mysqli->error);
            $query = $mysqli->query("SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
            $result = $query->fetch_array();
            return $result;
        }
        return $result;
    }

  
}

?>

