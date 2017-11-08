<?php
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
session_start();
if(isset($_SESSION['hashtag_admin']) && $_SESSION['hashtag_admin'] == 1) {
 require_once('config.php');
	if(isset($_POST['action']) && $_POST['action'] == 'add'){
		require_once('lib/twitter/twitteroauth.php');
		switch($_POST['tweet_type']){
			case 'now':
			{
				$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, TOKEN_SECRET);
				if(isset($_POST['all']) && $_POST['all'] == 'YES'){
					$users = $mysqli->query("SELECT * FROM users ");
				} else if(isset($_POST['uids']) && !empty($_POST['uids'])){
					$comma_separated = implode(",", $_POST['uids']);
					$users = $mysqli->query("SELECT * FROM users WHERE  id IN (".$comma_separated.");");
				} else {
						echo " اختر حساباتك !!!";
						exit;
				}
				
				$txtwi = strip_tags($_POST['txtwi']);
				if($txtwi){
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
						$hashs  ="\n";
					}
					$tweet_length = mb_strlen($txtwi, 'UTF-8');
					$hashs_ln = 140 - $tweet_length;  // Hashtags Length
					for($i = 0; $i < 10; $i++){
						$temp = $hashs .' '.$hashtags[0]->trends[$i]->name;
							if(mb_strlen($temp, 'UTF-8') < $hashs_ln)
								$hashs .=' '.$hashtags[0]->trends[$i]->name;
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
					
					// print_r($oksend->id_str); 	
					$msg = "<script> $(document).ready(function(){ 
								$('#alert').show().animate({opacity: 1.0}, 3000).fadeOut(500);
							});						 </script>
						<div class='alert alert-success' id='alert' >تم الإنتهاء من التغريد</div>";
					
			} break;
			case 'save':
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
						$hashtag_location = $mysqli->real_escape_string($_POST['hashtag_location']);
						$sqli = "INSERT INTO `tweets`(`id`, `tweet`, `user_id`, `count`,`hashtag_location`)  
							VALUES (NULL,'$tweet_txt',$user_id ,0 ,'$hashtag_location');";
					
					$mysqli->query($sqli); 
					$msg = "<br/><center><span class='label label-success'>تم </span></center>
									  <meta http-equiv='refresh' content='2; url=tweet.php'>";
							
			} break;
			default:
			
		
		}	
	}	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<title>Parmagy.com | سكربت هاشتاجي </title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="author" content="parmagy.com">
<link href="./css/style.css" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="icons/favicon.png">
</head>
<body>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
<ul class="breadcrumb">
        <li class="active"><b>تغريد بالهاشتاجات</b></li>
      </ul>
   <div class="alert alert-info"> غرد لكل حساباتك</div>
<div>
 
 <?php echo(isset($msg))? $msg :''; ?>
<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
    <div class="form-group">
	    <label>غرد :</label>
		<textarea rows="3"  style="width: 60%;" id="tw" name="txtwi" placeholder="غرد هنا" ></textarea></td>
    </div>
		<br/>
		<table>
		
			<tr><td colspan='3'><h5> النشر بالهاشتاجات النشطه : </h5></td></tr>
			<tr>
				<td>	<select  name="hashtag_location" >
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
			
		<select class="span3" name='tweet_type'>
			<option value='save' selected>حفظ </option>
			<option value='now'>تغريد فوري الآن</option>
		</select>
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