<?php  /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
 @session_start();    require_once("lib/twitter/twitteroauth.php");  require_once('config.php');  
 if (!isset($_SESSION['access_token']) || !isset($_SESSION['access_token']['oauth_token']) || !isset($_SESSION['access_token']['oauth_token_secret'])) {   
 $RBF8B88EE528AF32AC3F99B5BC0419B30 = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);      
 $R9414C34785EA4C10C501BB064C11973B = $RBF8B88EE528AF32AC3F99B5BC0419B30->getRequestToken(OAUTH_CALLBACK); 
 
 if ($RBF8B88EE528AF32AC3F99B5BC0419B30->http_code == 200) {        
 $R6E4F14B335243BE656C65E3ED9E1B115 = $RBF8B88EE528AF32AC3F99B5BC0419B30->getAuthorizeURL($R9414C34785EA4C10C501BB064C11973B['oauth_token']);
 $_SESSION['oauth_token'] = $R9414C34785EA4C10C501BB064C11973B['oauth_token'];    
 $_SESSION['oauth_token_secret'] = $R9414C34785EA4C10C501BB064C11973B['oauth_token_secret'];   
 header('Location: ' . $R6E4F14B335243BE656C65E3ED9E1B115);   
 
 } else {       echo "ERROR";   }  } else {   header("Location: index.php");  }  ?>