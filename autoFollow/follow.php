<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
session_start();
if(isset($_SESSION['tweet_admin']) && $_SESSION['tweet_admin'] == 1) {
 require_once("header.php");
 require_once('config.php');
	if(isset($_POST['action']) && $_POST['action'] == 'add'){
		require("lib/twitter/twitteroauth.php");
		switch($_POST['follow_type']){
			case 'now':
			{
				 if(isset($_POST['uid']) && !empty($_POST['uid']) && !empty($_POST['account_f'])){
					$row = $mysqli->query("SELECT * FROM users WHERE  id = ".$_POST['uid']);
				
					$user = $row->fetch_assoc();
					$accessToken = $user['accessToken'];
					$accessTokenSecret =$user['accessTokenSecret'];

					 $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
					 $account = strip_tags($_POST['account_f']);
				
					$followersList = $twitter->get('followers/list', array('screen_name' => $account, 'count'=>$_POST['follow_count'],'skip_status'=>1,
																		   'include_user_entities'=>false));
					
					//print_r($followersList);
					//exit;
					 
					foreach($followersList->users as $k=>$follower){
						$isfollow = $twitter->get('friendships/show', array('source_screen_name' => $user['screen_name'], 'target_screen_name' => $follower->screen_name)); 
						if(!$isfollow->relationship->source->following){
									$twitter->post('friendships/create', array('screen_name' => $follower->screen_name));  
						}

					}
					 
					 $msg = "<br/><center><span class='label label-success'> تم الإنتهاء من عملية المتابعه</span></center><meta http-equiv='refresh' content='2'>";
				} else {
					$msg =  "<br/><center><span class='label label-warning'> اختر حساباتك !!!  </span></center><meta http-equiv='refresh' content='2'>";
				}
							
				
			} break;
			case 'schedule':
			{
				 if(isset($_POST['uid']) && !empty($_POST['uid']) && !empty($_POST['account_f'])){
					$user_id = $_POST['uid'];
					$f_count = $_POST['follow_count'];
					$unfollow = $_POST['unfollow_time'];
				 	$account = strip_tags($_POST['account_f']);
					 
					$sqli = "INSERT INTO `follows`(`id`, `account_f`, `user_id`,`timestamp`,`f_count`,`unfollow`)  
							VALUES (NULL,'$account',$user_id,NOW(),$f_count,'$unfollow');";
							
					$mysqli->query($sqli); 
					$msg = "<br/><center><span class='label label-success'>تم إضافة الحساب </span></center>
									  <meta http-equiv='refresh' content='2'>";
				 }			  
							
			} break;
			default:
			
		
		}	
	}	
?>

<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
<ul class="breadcrumb">
        <li class="active"><b>المتابعة للحسابات  المتابعين لحساب معين </b></li>
      </ul>
<div>
 
 <?php echo(isset($msg))? $msg :''; ?>
<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
    <div class="form-group">
	    <label>أضف الحساب :</label>
		<input type="text" name="account_f" style="text-align:left;" />
		
    </div><br/>
	 <br/>
	 <div class="form-group">
	    <label>عدد المتابعين  :</label>
		<input type="text" name="follow_count"  class="span3" style="text-align:left;"  value='' />
		
    </div><br/>
	 <div class="form-group">
	    <label>عمل إلغاء متابعه لكل الحسابات بعد / يوم :</label>
		<input type="text" name="unfollow_time"  class="span3" style="text-align:left;"  value='' /> يوم 
		
    </div><br/>
	 
		<select class="span3" name='follow_type'>
			<!-- option value='now' selected>متابعة الآن </option -->
			<option value='schedule' selected>متابعة بالتوالي  يومياً   </option>
		</select>
		<br/>
		<hr/>
		<!--   ================ -->
		<h5>اختر من حساباتك الحساب الذي يتابع الحسابات الآخري   </h5>
<table class="table table-bordered">
    <thead>
    <tr> 	<th>ID </th>
			<th> الاسم </th>
			<th> اسم تويتر </th>
    </tr>
    </thead>
    <tbody>
<?php  
if ($result = $mysqli->query("SELECT  *  FROM `users` ")) {
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
       echo '<tr><td><input type="radio" name="uid" value="'.$row['id'].'"/></td>
		<td>'.$row['username'].'</td>
		<td><a href="https://twitter.com/'.$row['screen_name'].'">'.$row['screen_name'].'</a></td>
		</tr>';
    }

    /* free result set */
    $result->free();
}
/* close connection */
$mysqli->close();
?>
    </tbody>
    </table>
		
		
		<!-- ================== -->
    <div class="form-group">
	<input type="hidden" name="action" value="add" />
	<input type="hidden" name="timezone" id="timezone" value="" />
    <button  type="submit" class="btn btn-large btn-success"> حفظ الإعدادات </button>
    </div>
	
 </form>

</div>
 

 </div>
<div id="msg"></div>
</div>
</div>
<?php
} else 
    {  echo "<meta http-equiv='refresh' content='0;URL=index.php'>";	}


?>