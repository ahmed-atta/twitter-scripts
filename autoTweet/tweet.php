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
		require_once('lib/twitter/twitter.class.php');
		switch($_POST['tweet_type']){
			case 'now':
			{
				if(isset($_POST['all']) && $_POST['all'] == 'YES'){
					$users = $mysqli->query("SELECT * FROM users ");
				} else if(isset($_POST['uids']) && !empty($_POST['uids'])){
					$comma_separated = implode(",", $_POST['uids']);
					$users = $mysqli->query("SELECT * FROM users WHERE  id IN (".$comma_separated.");");
				} else {
						echo " اختر حساباتك !!!";
						exit;
				}
				
				$nums = $users->num_rows;
				$txtwi = strip_tags($_POST['txtwi']);
				$consumerKey = CONSUMER_KEY;
				$consumerSecret = CONSUMER_SECRET;
				while($rows = $users->fetch_assoc()) {
					$accessToken = $rows['accessToken'];
					$accessTokenSecret =$rows['accessTokenSecret'];
					$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
					$twitter->send($txtwi);
				}
				$msg = "<br/><center><span class='label label-success'> تم الإنتهاء من التغريد  </span></center>
				<meta http-equiv='refresh' content='3'>";
			} break;
			case 'schedule':
			{
				if(isset($_POST['all']) && $_POST['all'] == 'YES'){
					$user_id = -1; 
				} else if(isset($_POST['uids']) && !empty($_POST['uids'])){
					$comma_separated = implode(",", $_POST['uids']);
					$user_id = $comma_separated; 	  // tweet for each account
				} else {
					echo " اختر حساباتك !!!";
					exit;
				}
					@$tweet_txt = strip_tags($_POST['txtwi']);
					@$time = strtotime($_POST['tweet_time']);
					$newformat = date('Y-m-d H:i:s',$time);
					@$time = $newformat;
					//date("Y-m-d H:i:s", $date);
					$loop = (isset($_POST['is_loop']) && $_POST['is_loop'] == 'YES')? 1 : 0;
					$timezone = $_POST['timezone'];
					$interval = (isset($_POST['loop_interval']))? $_POST['loop_interval']: 0;
					$sqli = "INSERT INTO `tweets`(`id`, `timestamp`, `tweet`, `user_id`, `count`, `loop`, `interval`, `last_access`)  
							VALUES (NULL,'$time','$tweet_txt','$user_id' ,'0','$loop','$interval','$time');";
							
					$mysqli->query($sqli); 
					$msg = "<br/><center><span class='label label-success'>تم جدولة التغريدة  </span></center>
									  <meta http-equiv='refresh' content='2; url=tweet.php'>";
							
			} break;
			default:
			
		
		}	
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
				//if($("#cc").length==0){window.location="http://parmagy.com/"}
				//if($("#cc a").html()!="PARMAGY.COM"){window.location="http://parmagy.com/"}
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
   <div class="alert alert-info"> غرد لكل حساباتك</div>
<div>
 
 <?php echo(isset($msg))? $msg :''; ?>
<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
    <div class="form-group">
	    <label>غرد :</label>
		<textarea rows="3"  style="width: 60%;" id="tw" name="txtwi" placeholder="غرد هنا" ></textarea></td>
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
			
		<select class="span3" name='tweet_type'>
			<option value='schedule' selected>جدولة</option>
			<option value='now'>تغريد فوري الآن</option>
		</select>
		<br/>
		<hr/>
		<!--   ================ -->
		<div class="checkbox">
				<input type="checkbox" name="all" value="YES"/><label>&nbsp;&nbsp;  كل الحسابات  </label> </div>
		<h3>اختر من حساباتك  </h3>
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
       echo '<tr><td><input type="checkbox" name="uids[]" value="'.$row['id'].'"/></td>
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
    <button  type="submit" class="btn btn-large btn-success"> حفظ التغريدة</button>
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