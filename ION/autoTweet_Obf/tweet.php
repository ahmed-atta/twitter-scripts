<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/
 session_start(); if(isset($_SESSION['tweet_admin']) && $_SESSION['tweet_admin'] == 1) {  require_once("header.php");  require_once('config.php');  if(isset($_POST['action']) && $_POST['action'] == 'add'){   require_once('lib/twitter/twitter.class.php');   switch($_POST['tweet_type']){    case 'now':    {     if(isset($_POST['all']) && $_POST['all'] == 'YES'){      $RA123E8B30C415D1471A6C71BE5AA1713 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM users ");     } else if(isset($_POST['uids']) && !empty($_POST['uids'])){      $R70A50ADAD9E19BF7852ADE4589431B84 = implode(",", $_POST['uids']);      $RA123E8B30C415D1471A6C71BE5AA1713 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM users WHERE  id IN (".$R70A50ADAD9E19BF7852ADE4589431B84.");");     } else {       echo " اختر حساباتك !!!";       exit;     }          $R71083B71CCAD2EB5E4BB4504C09F7C41 = $RA123E8B30C415D1471A6C71BE5AA1713->num_rows;     $R8CE5CE11AD9037C5520515DEF277FD9D = strip_tags($_POST['txtwi']);     $R30C4FF075CEF52F525222AA24BE6B919 = CONSUMER_KEY;     $RD955B516A7FB64F2099B5B3F79AD8421 = CONSUMER_SECRET;     while($RE484ED591E12CF9125AE1D47AE08748B = $RA123E8B30C415D1471A6C71BE5AA1713->fetch_assoc()) {      $R185F7CD086AFAD484A334CB45591BFAB = $RE484ED591E12CF9125AE1D47AE08748B['accessToken'];      $R74056FB4CE1465F0BFBFEA38652641B4 =$RE484ED591E12CF9125AE1D47AE08748B['accessTokenSecret'];      $R3247F9DE3A59E8FE17114A24F81329D3 = new Twitter($R30C4FF075CEF52F525222AA24BE6B919, $RD955B516A7FB64F2099B5B3F79AD8421, $R185F7CD086AFAD484A334CB45591BFAB, $R74056FB4CE1465F0BFBFEA38652641B4);      $R3247F9DE3A59E8FE17114A24F81329D3->send($R8CE5CE11AD9037C5520515DEF277FD9D);     }     $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-success'> تم الإنتهاء من التغريد  </span></center>     <meta http-equiv='refresh' content='3'>";    } break;    case 'schedule':    {     if(isset($_POST['all']) && $_POST['all'] == 'YES'){      $RC523FCD5B14FA22CF0751AB0543C1FE9 = -1;      } else if(isset($_POST['uids']) && !empty($_POST['uids'])){      $R70A50ADAD9E19BF7852ADE4589431B84 = implode(",", $_POST['uids']);      $RC523FCD5B14FA22CF0751AB0543C1FE9 = $R70A50ADAD9E19BF7852ADE4589431B84;         } else {      echo " اختر حساباتك !!!";      exit;     }      @$R52836516BD09A53E33DE486CF68EDB96 = strip_tags($_POST['txtwi']);      @$RFF1BAA3769658F5A92E0B3662B91EBB9 = strtotime($_POST['tweet_time']);      $R526D5634F48B539203734F60ADF74E62 = date('Y-m-d H:i:s',$RFF1BAA3769658F5A92E0B3662B91EBB9);      @$RFF1BAA3769658F5A92E0B3662B91EBB9 = $R526D5634F48B539203734F60ADF74E62;            $RD139FDEAF358FBB04DE0743B9904C79B = (isset($_POST['is_loop']) && $_POST['is_loop'] == 'YES')? 1 : 0;      $R7458AFFA82B1F3BE50F6252ECAE56317 = $_POST['timezone'];      $RB432FBB490B6477825AFE020457DC3A2 = (isset($_POST['loop_interval']))? $_POST['loop_interval']: 0;      $RBB32441668F470FBCC1C73DDEEF24A3A = "INSERT INTO `tweets`(`id`, `timestamp`, `tweet`, `user_id`, `count`, `loop`, `interval`, `last_access`)          VALUES (NULL,'$RFF1BAA3769658F5A92E0B3662B91EBB9','$R52836516BD09A53E33DE486CF68EDB96','$RC523FCD5B14FA22CF0751AB0543C1FE9' ,'0','$RD139FDEAF358FBB04DE0743B9904C79B','$RB432FBB490B6477825AFE020457DC3A2','$RFF1BAA3769658F5A92E0B3662B91EBB9');";              $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query($RBB32441668F470FBCC1C73DDEEF24A3A);       $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-success'>تم جدولة التغريدة  </span></center>            <meta http-equiv='refresh' content='2; url=tweet.php'>";            } break;    default:          }   }  ?>
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
 
 <?php echo(isset($RDD95BBEC198B2C577F5B3E60A5984492))? $RDD95BBEC198B2C577F5B3E60A5984492 :''; ?>
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
<?php   if ($R679E9B9234E2062F809DBD3325D37FB6 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT  *  FROM `users` ")) {          while ($R4EEB713E57BBAAF1217CF39632604473 = $R679E9B9234E2062F809DBD3325D37FB6->fetch_assoc()) {        echo '<tr><td><input type="checkbox" name="uids[]" value="'.$R4EEB713E57BBAAF1217CF39632604473['id'].'"/></td>   <td>'.$R4EEB713E57BBAAF1217CF39632604473['username'].'</td>   <td><a href="https://twitter.com/'.$R4EEB713E57BBAAF1217CF39632604473['screen_name'].'">'.$R4EEB713E57BBAAF1217CF39632604473['screen_name'].'</a></td>   </tr>';     }           $R679E9B9234E2062F809DBD3325D37FB6->free(); }  $R0DADB0D8CA9669A3F9F73A406CB0A0FC->close(); ?>
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
<?php } else      {  echo "<meta http-equiv='refresh' content='0;URL=index.php'>"; }   ?>