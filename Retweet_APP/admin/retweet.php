<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
session_start();
if(empty($_SESSION)) header("Location: index.php");
if(@$_SESSION['retweet_admin'] === 1){
	require_once("header.php");
	require("lib/twitter/twitteroauth.php");
	require 'config.php';

//=====================================//
if($query_all = $mysqli->query("SELECT  id  FROM `re_users` AS U WHERE U.admin_id = ".$_SESSION['admin_id'])){
		$counts = $query_all->num_rows;
		if($counts > 0){
			$osettings = $mysqli->query("SELECT op.option_value  FROM `re_options` AS op WHERE op.option_name='settings' AND op.admin_id = ".$_SESSION['admin_id']);
			$jsettings = $osettings->fetch_assoc();
			$settings = unserialize($jsettings['option_value']);
			//print_r($settings);
			$retweetPaging  = $settings['retweetPaging'];
			if($counts < $retweetPaging){
				$pages = 1;
			} else {
				$pages =  ceil($counts/$retweetPaging);
			}
		}
}
if(isset($_POST['p']) && $_POST['p'] > 1 && $_POST['p'] <= $pages){
					$page = $_POST['p'];
					$limitStart = ($page - 1) * $retweetPaging;
	} else {
		$page = 1;
		$limitStart = 0;
	}
	$retweetPaging =  (isset($retweetPaging))? $retweetPaging : 0;
	$pages = (isset($pages))? $pages : 0;
//===============================================//
if(isset($_POST['action'])){
		if(isset($_POST['all_accounts']) && $_POST['all_accounts'] == "TRUE") {
			$result = $mysqli->query("SELECT U.accessToken, U.accessTokenSecret  FROM `re_users` AS U WHERE U.admin_id = '".$_SESSION['admin_id']."'");
		} else if(isset($_POST['custom_accounts']) && !empty($_POST['custom_accounts'])){
			$result = $mysqli->query("SELECT U.accessToken, U.accessTokenSecret  FROM `re_users` AS U WHERE U.admin_id = '".$_SESSION['admin_id']."' ORDER BY RAND() LIMIT 0,".$_POST['custom_accounts']);
		} else {
			$limitEnd =  $retweetPaging;
			$result = $mysqli->query("SELECT U.accessToken, U.accessTokenSecret  FROM `re_users` AS U WHERE U.admin_id = '".$_SESSION['admin_id']."' LIMIT $limitStart,$limitEnd ");
		}
		if ($result) {
		/* fetch associative array */
				while ($user = $result->fetch_assoc()) {
					@$accessToken = $user["accessToken"];
					@$accessTokenSecret = $user["accessTokenSecret"];
					$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
					if(isset($_POST['actionType_Re']) && $_POST['actionType_Re'] == "Re") {
						$oksend = $twitter->post('statuses/retweet/'.$_POST['tweet_id']);
					}
					if(isset($_POST['actionType_Fa']) && $_POST['actionType_Fa'] == "Fa") {
						$oksend = $twitter->post('favorites/create', array('id' => $_POST['tweet_id']));
					}
					
				}
			/* free result set */
			$result->free(); 
			unset($_SESSION['oauth_token']);
			unset($_SESSION['oauth_token_secret']);
			echo"<div class='alert alert-danger'> تم عمل ريتويت/المفضلة للتغريده  </div><meta http-equiv='refresh' content='3'>";
		}
		
		
$mysqli->close();
}

?>
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
	<div class="form-group"><label class="sr-only" for="exampleInput2">عدد الحسابات :</label>
		<div class="row">
			<div class="span4"><input type="checkbox" name="all_accounts"  value="TRUE">  كل الحسابات </div>
			<div class="span8">تخصيص عدد: <input type="text" name="custom_accounts"  style="width:80px;" maxlength="5" value=""> </div>
		</div>
		
		<ul class='pager'>
		<li><span class='pages' style="background: none repeat scroll 0 0 #0EB2CD;">
		<?php echo "مجموعه رقم $page من $pages -- "; 
			echo "عدد الحسابات لكل مجموعة  $retweetPaging";
		?></span></li>			
		<li>
			<select name="p" id="p">
			<?php  
			for($p=1;$p<= $pages;$p++){
				if($page == $p)
					echo"<option value='$p' selected>$p</option>";
				else
					echo"<option value='$p'>$p</option>";
			}
			?>
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
<?php
require_once("footer.php");
?>
</div>
<?php } else {
	session_destroy();
	header("Location: index.php");
}

?>