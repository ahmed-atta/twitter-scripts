<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/  
 session_start(); if(empty($_SESSION)) header("Location: index.php"); if(@$_SESSION['retweet_admin'] === 1){  require_once("header.php");  require("lib/twitter/twitteroauth.php");  require 'config.php';   if($R3E910675E049B592AEABF360C90B6B1F = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT  id  FROM `re_users`")){   $RA4670B6CC8C17F77F7FE39EC1B8564DA = $R3E910675E049B592AEABF360C90B6B1F->num_rows;   if($RA4670B6CC8C17F77F7FE39EC1B8564DA > 0){    $R982EC780FF644E3918500730D113F429 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT op.option_value  FROM `re_options` AS op WHERE op.option_name='settings' ");    $R17B76B3A5049090BFF388BA7A9604A29 = $R982EC780FF644E3918500730D113F429->fetch_assoc();    $RFB8E5BFE7DAE6EF247076501F0556277 = unserialize($R17B76B3A5049090BFF388BA7A9604A29['option_value']);        $R3218BDF9087452EE011F4C7B1585D234  = $RFB8E5BFE7DAE6EF247076501F0556277['retweetPaging'];    if($RA4670B6CC8C17F77F7FE39EC1B8564DA < $R3218BDF9087452EE011F4C7B1585D234){     $RCDFB3313F5706C6951E32E3AB8CF5FF0 = 1;    } else {     $RCDFB3313F5706C6951E32E3AB8CF5FF0 =  ceil($RA4670B6CC8C17F77F7FE39EC1B8564DA/$R3218BDF9087452EE011F4C7B1585D234);    }   } } if(isset($_POST['p']) && $_POST['p'] > 1 && $_POST['p'] <= $RCDFB3313F5706C6951E32E3AB8CF5FF0){      $R71A6FD054F6EBC38E69167AB39449848 = $_POST['p'];      $RE4E384CFCF466118E43EFFEC08720D83 = ($R71A6FD054F6EBC38E69167AB39449848 - 1) * $R3218BDF9087452EE011F4C7B1585D234;  } else {   $R71A6FD054F6EBC38E69167AB39449848 = 1;   $RE4E384CFCF466118E43EFFEC08720D83 = 0;  }  $R3218BDF9087452EE011F4C7B1585D234 =  (isset($R3218BDF9087452EE011F4C7B1585D234))? $R3218BDF9087452EE011F4C7B1585D234 : 0;  $RCDFB3313F5706C6951E32E3AB8CF5FF0 = (isset($RCDFB3313F5706C6951E32E3AB8CF5FF0))? $RCDFB3313F5706C6951E32E3AB8CF5FF0 : 0;  if(isset($_POST['action'])){   if(isset($_POST['all_accounts']) && $_POST['all_accounts'] == "TRUE") {    $R679E9B9234E2062F809DBD3325D37FB6 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT U.accessToken, U.accessTokenSecret  FROM `re_users` AS U ");   } else if(isset($_POST['custom_accounts']) && !empty($_POST['custom_accounts'])){    $R679E9B9234E2062F809DBD3325D37FB6 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT U.accessToken, U.accessTokenSecret  FROM `re_users` AS U  ORDER BY RAND() LIMIT 0,".$_POST['custom_accounts']);   } else {    $RCAB434FD919205A9524E1B54064F6490 =  $R3218BDF9087452EE011F4C7B1585D234;    $R679E9B9234E2062F809DBD3325D37FB6 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT U.accessToken, U.accessTokenSecret  FROM `re_users` AS U  LIMIT $RE4E384CFCF466118E43EFFEC08720D83,$RCAB434FD919205A9524E1B54064F6490 ");   }   if ($R679E9B9234E2062F809DBD3325D37FB6) {        while ($RE0D5EDB560A26D4E1BECD832EA026E32 = $R679E9B9234E2062F809DBD3325D37FB6->fetch_assoc()) {      @$R185F7CD086AFAD484A334CB45591BFAB = $RE0D5EDB560A26D4E1BECD832EA026E32["accessToken"];      @$R74056FB4CE1465F0BFBFEA38652641B4 = $RE0D5EDB560A26D4E1BECD832EA026E32["accessTokenSecret"];      $R3247F9DE3A59E8FE17114A24F81329D3 = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $R185F7CD086AFAD484A334CB45591BFAB, $R74056FB4CE1465F0BFBFEA38652641B4);      if(isset($_POST['actionType_Re']) && $_POST['actionType_Re'] == "Re") {       $R8C072FDF530C84D973287CC76B48DE1A = $R3247F9DE3A59E8FE17114A24F81329D3->post('statuses/retweet/'.$_POST['tweet_id']);      }      if(isset($_POST['actionType_Fa']) && $_POST['actionType_Fa'] == "Fa") {       $R8C072FDF530C84D973287CC76B48DE1A = $R3247F9DE3A59E8FE17114A24F81329D3->post('favorites/create', array('id' => $_POST['tweet_id']));      }           }        $R679E9B9234E2062F809DBD3325D37FB6->free();     unset($_SESSION['oauth_token']);    unset($_SESSION['oauth_token_secret']);    echo"<br/><center><span class='label label-success'> تم عمل ريتويت/المفضلة للتغريده  </span></center>     <meta http-equiv='refresh' content='3'>";   }       $R0DADB0D8CA9669A3F9F73A406CB0A0FC->close(); }  ?>
<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
<ul class="breadcrumb">
        <li class="active"><b>ريتويت لهذه التغريدة</b></li>
      </ul>
   <div class="alert alert-info"> (انسخ رقم التغريده كما بالصوره) </div>

 <div style='text-align:center'><img src="images/retweet.png" /> </div>
<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
    <div class="form-group">
	<label>رقم التغريده  :</label><br/>
		<input type="text" name="tweet_id" id="tweet_id" style="text-align:left;" dir="ltr"/>
    </div>
	<br/>
	<div class="alert alert-info"> (عدد الحسابات التي ستقوم بعمل ريتويت لهذه التغريده) 
	<br/>
	يفضل إستخدام نظام المجموعات إذا كان عدد الحسابات كبير ويسبب بطء في عملية المعالجة 
	</div>
	<div class="form-group">
		<label class="sr-only" for="exampleInput2">عدد الحسابات :</label>
		<div><input type="checkbox" name="all_accounts"  value="TRUE">  كل الحسابات </div>
		<div><label>تخصيص عدد: </label><input type="text" name="custom_accounts"  style="width:80px;" maxlength="5" value="">  </div>
		<ul class='pager'>
		<li><span class='pages' style="background: none repeat scroll 0 0 #0EB2CD;">
		<?php echo "مجموعه رقم $R71A6FD054F6EBC38E69167AB39449848 من $RCDFB3313F5706C6951E32E3AB8CF5FF0 -- ";     echo "عدد الحسابات لكل مجموعة  $R3218BDF9087452EE011F4C7B1585D234";   ?></span></li>			
		<li>
			<select name="p" id="p">
			<?php      for($R2A039ED8FDBF4CEAA9E79CDC3AECD1A2=1;$R2A039ED8FDBF4CEAA9E79CDC3AECD1A2<= $RCDFB3313F5706C6951E32E3AB8CF5FF0;$R2A039ED8FDBF4CEAA9E79CDC3AECD1A2++){     if($R71A6FD054F6EBC38E69167AB39449848 == $R2A039ED8FDBF4CEAA9E79CDC3AECD1A2)      echo"<option value='$R2A039ED8FDBF4CEAA9E79CDC3AECD1A2' selected>$R2A039ED8FDBF4CEAA9E79CDC3AECD1A2</option>";     else      echo"<option value='$R2A039ED8FDBF4CEAA9E79CDC3AECD1A2'>$R2A039ED8FDBF4CEAA9E79CDC3AECD1A2</option>";    }    ?>
			</select>
		</li>
		</ul>	
	</div>
	<div style='clear:both;'></div> <br/>
	<div class="form-group">
		<label class="sr-only" for="exampleInput2">تريد عمل ريتويت / المفضلة  :</label>
		<label class="checkbox-inline"><input type="checkbox" name="actionType_Re" id="inlineCheckbox1" value="Re"> ريتــويت</label>
		<label class="checkbox-inline"><input type="checkbox" name="actionType_Fa" id="inlineCheckbox2" value="Fa"> المفضلة</label>
	</div>
		<br/>
	<input type="hidden" name="action" value="retweet" />
    <button  type="submit" class="btn btn-default"> ريتويت على حساباتي </button>
  
 </form>
</div>

 </div>

 </div>
<?php require_once("footer.php"); ?>
</div>
<?php } else {  session_destroy();  header("Location: index.php"); }  ?>