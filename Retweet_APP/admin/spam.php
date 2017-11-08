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
//=============================================//
if(isset($_POST['action'])){
		if(isset($_POST['all_accounts']) && $_POST['all_accounts'] == "TRUE") {
			$result = $mysqli->query("SELECT U.accessToken, U.accessTokenSecret,U.screen_name  FROM `re_users` AS U WHERE U.admin_id = '".$_SESSION['admin_id']."'");
		} else if(isset($_POST['custom_accounts']) && !empty($_POST['custom_accounts']) ){
			$result = $mysqli->query("SELECT U.accessToken, U.accessTokenSecret ,U.screen_name  FROM `re_users` AS U WHERE U.admin_id = '".$_SESSION['admin_id']."' ORDER BY RAND() LIMIT 0,".$_POST['custom_accounts']);
		} else {
			$limitEnd = $retweetPaging;
			$result = $mysqli->query("SELECT U.accessToken, U.accessTokenSecret,U.screen_name  FROM `re_users` AS U WHERE U.admin_id = '".$_SESSION['admin_id']."'  LIMIT $limitStart,$limitEnd");
		}
		if ($result) {
			/* fetch associative array */
				while ($user = $result->fetch_assoc()) {
					@$accessToken = $user["accessToken"];
					@$accessTokenSecret = $user["accessTokenSecret"];
					$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
					//$oksend = $twitter->post('statuses/retweet/'.$_POST['tweet_id']);  
					$twitter->post('users/report_spam', array('screen_name' => $_POST['twitter_name']));  
				}
				$msg = "<div class='alert alert-danger'> تم إرسال سبام لهذا الحساب </div><meta http-equiv='refresh' content='3'>";
				$result->free(); 
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
        <li class="active"><b>إرسال سبام </b></li>
      </ul>
 <div class="alert alert-info"><b>(اجعل حساباتك ترسل سبام عن هذا الحساب)<b/></div>
<?php echo (isset($msg))? $msg: ""; ?>
<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
    <div class="form-group" >
	<label>حساب تويتر : </label>
	<br/>
		<div class="input-group">
			<input type="text" name="twitter_name" class="form-control" placeholder="Username" style="text-align:left;" dir="ltr">
			<span class="input-group-addon">@</span>
		</div>
    </div>
	<br/>
	<br/>
	<div class="alert alert-info">(عدد الحسابات التي تريد أن يرسلوا سبام لهذا الحساب) 
	<br/>
	يفضل إستخدام نظام المجموعات إذا كان عدد الحسابات كبير ويسبب بطء في عملية المعالجة 
	</div>
	<div class="form-group">
		<label class="sr-only" for="exampleInput2">عدد الحسابات :</label>
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
	
	<br/>
	<input type="hidden" name="action" value="un/follow" />
    <button  type="submit" class="btn btn-default">إرسال سبام </button>
  
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