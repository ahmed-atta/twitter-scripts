<?php
/** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
 @session_start();  require("lib/twitter/twitteroauth.php");  require('config.php');  require 'lib/user.class.php'; if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {           $RBF8B88EE528AF32AC3F99B5BC0419B30 = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);       $RF33CF623B91B90CB9DE7AA9FF41EB9D8 = $RBF8B88EE528AF32AC3F99B5BC0419B30->getAccessToken($_GET['oauth_verifier']);       $_SESSION['access_token'] = $RF33CF623B91B90CB9DE7AA9FF41EB9D8;       $REF2E2A1B08A84447C0216DB24BB66FF1 = $RBF8B88EE528AF32AC3F99B5BC0419B30->get('account/verify_credentials');                if (isset($REF2E2A1B08A84447C0216DB24BB66FF1->error)) {                   header('Location: login-twitter.php');      } else {   $RB999BEA28440911E1DEB8E47706A1061 = $_SESSION['access_token']['oauth_token'] ;   $RF0ADABB689EBB9E7072F280EF3EB4F11 = $_SESSION['access_token']['oauth_token_secret'];    $RC28E336CF376A39981A608C5C2A8A29C= $_SESSION['oauth_token'];    $R9D71AF120B1CEDE35AAD1C0FB7629893= $_SESSION['oauth_token_secret'];   $R517C8C6C47B742944A030A8DE3977256 = $_SESSION['access_token']['screen_name'];          $R2436D353F17A5E5D379DE74D9BFD3B56 = $REF2E2A1B08A84447C0216DB24BB66FF1->id;          $username = $REF2E2A1B08A84447C0216DB24BB66FF1->name;          $RE0D5EDB560A26D4E1BECD832EA026E32 = new C8F9BFE9D1345237CB3B2B205864DA075();          $R0ECA2185DD05BB7BE469CFA84C1268B5 = $RE0D5EDB560A26D4E1BECD832EA026E32->FBAD39714CEE7D00E0928193FAA608D1F($R0DADB0D8CA9669A3F9F73A406CB0A0FC,$R2436D353F17A5E5D379DE74D9BFD3B56, 'twitter',            $username,$RC28E336CF376A39981A608C5C2A8A29C,           $R9D71AF120B1CEDE35AAD1C0FB7629893,           $RB999BEA28440911E1DEB8E47706A1061,$RF0ADABB689EBB9E7072F280EF3EB4F11,$R517C8C6C47B742944A030A8DE3977256);          if(!empty($R0ECA2185DD05BB7BE469CFA84C1268B5)){     unset($_SESSION['access_token']);     unset($_SESSION['access_token']['oauth_token']);      unset($_SESSION['access_token']['oauth_token_secret']);              @header("Location: accounts.php");     echo "<meta http-equiv='refresh' content='0;URL=accounts.php'>";          }      }  } else {             header("Location: index.php");  }  ?>
