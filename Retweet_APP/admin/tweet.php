<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
session_start();
if(isset($_SESSION['retweet_admin']) && $_SESSION['retweet_admin'] == 1) {
	require_once("header.php");
	require_once('lib/twitter/twitteroauth.php');
	require_once('config.php');
	if(isset($_POST['Save']) && $_POST['Save'] == "Save" && !empty($_POST['txtwi'])){

		@$tweet_txt = strip_tags($_POST['txtwi']);
		if(isset($_POST['tweet_time']) && !empty($_POST['tweet_time'])){
			$time = strtotime($_POST['tweet_time']);
			$newformat = date('Y-m-d H:i:s',$time);
			$time = $newformat;
		} else {
					$time = date('Y-m-d H:i:s');
		}
		//date("Y-m-d H:i:s", $date);
		$loop = (isset($_POST['is_loop']) && $_POST['is_loop'] == 'YES')? 1 : 0;
		$is_hashtag = (isset($_POST['is_hashtag']) && $_POST['is_hashtag'] == 'YES')? 1 : 0;
		$hashtag_location = ($is_hashtag)? $_POST['hashtag_location'] : "";

		$timezone = $_POST['timezone'];
		$interval = (isset($_POST['loop_interval']))? $_POST['loop_interval']: 0;
		$admin_id = $_SESSION['admin_id'];
		$user_id = -1;   // tweet for each account
		$sqli = "INSERT INTO `re_tweets`(`id`, `timestamp`, `tweet`, `user_id`, `count`, `loop`, `interval`, `last_access`,`admin_id`,`is_hashtag`,`hashtag_location`)  
							VALUES (NULL,'$time','$tweet_txt',$user_id ,'0','$loop','$interval','$time',$admin_id,'$is_hashtag','$hashtag_location');";
							
					$sql= $mysqli->query($sqli);
					$tweet_id = $mysqli->insert_id;
							
					$result = $mysqli->query("SELECT option_value FROM re_options WHERE option_name = 'timezone' AND admin_id=".$admin_id);
					if($result->num_rows < 1 ){
						$set_timezone = "INSERT INTO `re_options`(`id`, `option_name`, `option_value`,`admin_id`) VALUES 
								(NULL,'timezone','$timezone',$admin_id)";
								$mysqli->query($set_timezone);
					} else {
								$timezone_op = $result->fetch_assoc();
								if($timezone_op['option_value']!= $timezone){
									$mysqli->query("UPDATE re_options SET option_value='$timezone' WHERE admin_id=".$admin_id);
								}
					}
							 
					$msg = "<div class='alert alert-danger'> تم جدولة التغريدة </div> <meta http-equiv='refresh' content='2; url=tweet.php'>";
							
			
	} else if(isset($_POST['Now']) && $_POST['Now'] == "Now"){
		$users = $mysqli->query("SELECT * FROM re_users WHERE admin_id = ".$_SESSION['admin_id']);
		$nums = $users->num_rows;
		$txtwi = strip_tags($_POST['txtwi']);
		$is_hashtag = (isset($_POST['is_hashtag']) && $_POST['is_hashtag'] == 'YES')? 1 : 0;
		$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, TOKEN_SECRET);
		
		if($_POST['is_hashtag']){
					switch($_POST['hashtag_location']){
								case 'sa': 
									$woeid = "23424938";
									break;
								case 'eg':
									$woeid = "23424802";
									break;
								case 'kw':
									$woeid = "23424870"; 
									break;
								case 'ae':
									$woeid = "23424738"; 
									break;
								case 'qa':
									$woeid = "23424930"; 
									break;
								case 'bh':
									$woeid = "23424753"; 
									break;
								default:
					}
					$hashtags = $twitter->get('trends/place',array("id"=> $woeid));
		}
						$tweet_length = mb_strlen($txtwi, 'UTF-8');
						$hashs_ln = 140 - $tweet_length;  // Hashtags Length
						$hashs  ="\n";
						for($i = 0; $i < 10; $i++){
							$temp = $hashs ." ".$hashtags[0]->trends[$i]->name;
								if(mb_strlen($temp, 'UTF-8') < $hashs_ln)
									$hashs .="\r\n".$hashtags[0]->trends[$i]->name;
								else 
									break;	
						}
						$txtwi .= $hashs;
				while($rows = $users->fetch_assoc()) {
					$accessToken = $rows['accessToken'];
					$accessTokenSecret = $rows['accessTokenSecret'];
					$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
					$oksend = $twitter->post('statuses/update',array('status' =>$txtwi));
				}
				$msg = "<div class='alert alert-danger'> تم الإنتهاء من التغريد  </div> <meta http-equiv='refresh' content='2'>";
						
	
	}	
?>
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.8.21/themes/ui-lightness/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-timepicker-addon.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
<script>
$(document).ready(function(){
				var localTime = new Date();
				$("#timezone").val(localTime.getTimezoneOffset());
});
$(document).ready(function(){
	$('#s_time').datetimepicker({dateFormat:'yy-mm-dd',minDate:new Date()});
});
</script>
<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
<ul class="breadcrumb">
        <li class="active"><b>تغريد فوري/ جدولة تغريده</b></li>
      </ul>
   <div class="alert alert-info"> غرد لكل المشتركين</div>
<div>
 <?php echo(isset($msg))? $msg :''; ?>

<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
    <div class="form-group">
		<label>غرد :</label>
		<textarea rows="3"  style="width: 60%;" id="tw" name="txtwi" placeholder="غرد هنا" ></textarea>
		
		<label>يتم النشر في :</label>
		<input type="text" name="tweet_time" id="s_time" style="text-align:left;" dir="ltr"/>
    </div>
		<br/>
		<table>
			<tr>
				<td><div class="checkbox">
				<input type="checkbox" name="is_loop" value="YES"/><label>&nbsp;&nbsp;  تكرار </label> </div></td>
				<td style="padding-right:50px">تكرار كل :</td>
				<td><input type="text" name="loop_interval" style="width:50px"/> دقيقة </td>
			</tr>
			</table>
				<br/>
			
		<br/>
		<table>
		
			<tr><td colspan='3'><h5><input type="checkbox" name="is_hashtag" value="YES"/>&nbsp;&nbsp;  النشر بالهاشتاجات النشطه : </h5></td>
				<td><select  name="hashtag_location" >
				    <option value='sa'>المملكة العربية السعوديه</option>
					<option value='ae'>الإمارات العربيه المتحدة</option>
					<option value='bh'>البحرين</option>
					<option value='kw'>الكويت </option>
					<option value='qa'> قطر </option>
					<option value='eg'>جمهورية مصر العربية</option>
			        </select></td>
			</tr>
			
			</table>
				<br/>
		
		<br/>
		<br/>

	
    <div class="form-group">
	<input type="hidden" name="timezone" id="timezone" value="" />
    <button  type="submit" class="btn btn-large btn-success" name="Save" value="Save"> حفظ التغريدة</button>
	<button  type="submit" class="btn btn-large btn-success" name="Now" value="Now"> تغريد فوري</button>
    </div>
	
 </form>

</div>
 

 </div>

</div>
<?php	
	require_once("footer.php");
?>
</div>
 </body></html>
<?php
} else 
    {  echo "<meta http-equiv='refresh' content='0;URL=index.php'>";	}
?>