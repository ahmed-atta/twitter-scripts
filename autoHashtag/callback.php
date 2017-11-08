<?php
/** 
 * @author AHMED ATTA (parmagy.com)
 * @website http://demos.parmagy.com/twitter
 */
require("lib/twitter/twitteroauth.php");
require('config.php');
require 'lib/user.class.php';

session_start();
if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
    $_SESSION['access_token'] = $access_token;
// Let's get the user's info
    $user_info = $twitteroauth->get('account/verify_credentials');
  // Print user's info
	//header("Location: index.php");
   
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } else {
		$access_token_oauth_token = $_SESSION['access_token']['oauth_token'] ;
		$access_token_oauth_token_secret = $_SESSION['access_token']['oauth_token_secret'];
		$twitter_otoken= $_SESSION['oauth_token'];
		$twitter_otoken_secret= $_SESSION['oauth_token_secret'];
		$screen_name = $_SESSION['access_token']['screen_name'];
        $uid = $user_info->id;
        $username = $user_info->name;
        $user = new User();
        $userdata = $user->checkUser($mysqli,$uid, 'twitter', 
									$username,$twitter_otoken,
									$twitter_otoken_secret,
									$access_token_oauth_token,$access_token_oauth_token_secret,$screen_name);
        if(!empty($userdata)){
			unset($_SESSION['access_token']);
			unset($_SESSION['access_token']['oauth_token']); 
			unset($_SESSION['access_token']['oauth_token_secret']);
            header("Location: accounts.php");
			echo "<meta http-equiv='refresh' content='1;URL=accounts.php'>";
        }
    }
} else {
    // Something's missing, go back to square 1
    //header('Location: login-twitter.php');
	header("Location: index.php");
}
?>
