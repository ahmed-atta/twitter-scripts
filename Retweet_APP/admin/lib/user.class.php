<?php
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
class User {
    function checkUser($uid, 
						$oauth_provider, 
						$username,
						$admin_id,$twitter_otoken,
						$twitter_otoken_secret,
						$access_token_oauth_token,
						$access_token_oauth_token_secret,
						$screen_name) 
	{
        $query = mysql_query("SELECT * FROM `re_users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die(mysql_error());
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present
          $query = mysql_query("UPDATE `re_users` SET `twitter_oauth_token` = '$twitter_otoken',`twitter_oauth_token_secret` = '$twitter_otoken_secret',`accessToken` = '$access_token_oauth_token',`accessTokenSecret` = '$access_token_oauth_token_secret' WHERE  oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die(mysql_error());
        } else {
            #user not present. Insert a new Record
            $query = mysql_query("INSERT INTO `re_users` (oauth_provider, oauth_uid, username,admin_id,twitter_oauth_token,twitter_oauth_token_secret,accessToken,accessTokenSecret,screen_name)
			VALUES ('$oauth_provider', $uid, '$username','$admin_id','$twitter_otoken','$twitter_otoken_secret','$access_token_oauth_token','$access_token_oauth_token_secret','$screen_name')") or die(mysql_error());
            $query = mysql_query("SELECT * FROM `re_users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
            $result = mysql_fetch_array($query);
            return $result;
        }
        return $result;
    }

    
    
    

}
?>