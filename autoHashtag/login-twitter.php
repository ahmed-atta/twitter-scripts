<?php
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
require("lib/twitter/twitteroauth.php");
require 'config.php';
session_start();
if (!isset($_SESSION['access_token']) || !isset($_SESSION['access_token']['oauth_token']) || !isset($_SESSION['access_token']['oauth_token_secret'])) {
	
	$twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);		
	// Requesting authentication tokens, the parameter is the URL we will be redirected to
	$request_token = $twitteroauth->getRequestToken(OAUTH_CALLBACK); //
	// If everything goes well..
	if ($twitteroauth->http_code == 200) {

		// Let's generate the URL and redirect
		$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
		// Saving them into the session
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		header('Location: ' . $url);
	} else {
		// It's a bad idea to kill the script, but we've got to know when there's an error.
		die('خطأ الإتصال بتويتر ... تأكد من إعدادات تطبيق تويتر صحيحه ');
	}
} else {
	header("Location: index.php");
}
?>
