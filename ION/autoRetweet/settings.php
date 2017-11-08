<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
 session_start(); if(isset($_SESSION['retweet_admin']) && $_SESSION['retweet_admin'] == 1) {  require_once("header.php");  require_once('config.php');  if($R982EC780FF644E3918500730D113F429 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM re_options WHERE option_name ='settings' ")){   if($R982EC780FF644E3918500730D113F429->num_rows > 0 ){    $R17B76B3A5049090BFF388BA7A9604A29 = $R982EC780FF644E3918500730D113F429->fetch_assoc();    $RC3A7A3D5646A92325D1325EC9FDB7875 = unserialize($R17B76B3A5049090BFF388BA7A9604A29['option_value']);    $R07328AC423865932BD2330276754AB49  = $RC3A7A3D5646A92325D1325EC9FDB7875['accountsPaging'];    $R3218BDF9087452EE011F4C7B1585D234  = $RC3A7A3D5646A92325D1325EC9FDB7875 ['retweetPaging'];   }  }    if(isset($_POST['action'])){      $R285814C5B36A80ADC051FEBE21063122['accountsPaging'] = $_POST['accountsPaging'];   $R285814C5B36A80ADC051FEBE21063122['retweetPaging'] = $_POST['retweetPaging'];   $R1D7A4A94D83F32440EE87D2D4D9CEFC4 = serialize($R285814C5B36A80ADC051FEBE21063122);   $R7A5970B4F39DA54FC913E8AC63E13424 = $_SESSION['admin_id'];   if($R982EC780FF644E3918500730D113F429) {    if($R982EC780FF644E3918500730D113F429->num_rows > 0 ){     $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("UPDATE `re_options` SET option_value ='$R1D7A4A94D83F32440EE87D2D4D9CEFC4' WHERE option_name ='settings' ");    } else {     $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("INSERT INTO `re_options` (option_name,option_value,admin_id) VALUES ('settings','$R1D7A4A94D83F32440EE87D2D4D9CEFC4','1');" );    }   }   echo"<br/><center><span class='label label-success'>تم حفظ الإعدادات   </span></center>     <meta http-equiv='refresh' content='2'>";           }   ?>
<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
<ul class="breadcrumb">
        <li class="active"><b>إعدادات </b></li>
      </ul>
   <div class="alert alert-info"> </div>
<div>
<!-- ======================================================================= -->
<script type="text/javascript">
function loadXMLDoc(flag) {
	if(flag == 'retweet'){
		var xmlhttp;
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("msg").innerHTML = "<span class='label label-success '>تم البدء </span>";
			}
		}
		xmlhttp.open("GET", "auto-retweet-cron1.php", true);
		xmlhttp.send();
	} else if(flag =='clear_log'){
		document.getElementById("msg").innerHTML = "<span class='label label-success '>تم البدء </span>";
		var xmlhttp;
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("msg").innerHTML = "<span class='label label-success '>تم مسح الذاكره </span>";
			}
		}
		xmlhttp.open("GET", "clearLog.php", true);
		xmlhttp.send();
	}
	
}
</script>
<button type="button" class="btn btn-danger " onclick="javascript: return loadXMLDoc('retweet');">إبدأ الريتويت التلقائي الآن </button>
<?php if($_SESSION['admin_id'] == 1): ?>
<button type="button" class="btn btn-danger " onclick="javascript: return loadXMLDoc('clear_log');">مسح ذاكرة قاعدة البيانات </button>
<?php endif; ?>
<!-- ======================================================================= -->

 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
    <div class="form-group">
	<label for="accountsPaging">عدد الحسابات في صفحات حساباتي :</label>
	<select name="accountsPaging" id="accountsPaging" >
	<?php if(isset($R07328AC423865932BD2330276754AB49)){    switch($R07328AC423865932BD2330276754AB49){     case '20':      $R4C9B74F5A553D19469DB58BA5ADDC206 ="selected";     break;     case '50':      $R3FF8B17D7B489F8D5572486F5802A6EB ="selected";     break;     case '100':      $R5C739D4F034E5FF353F80BEBC20C3EB8 ="selected";     break;     case '200':      $R4031CAFBE886B17C5888C881A311C10C ="selected";     break;     case '500':      $R2B5F9EE16B1E79136FFD0F6DCEDCB994 ="selected";     break;     default:      $R4C9B74F5A553D19469DB58BA5ADDC206 ="selected";     break;    }  }?>

	  <option value='20' <?php echo(isset($R4C9B74F5A553D19469DB58BA5ADDC206))? $R4C9B74F5A553D19469DB58BA5ADDC206 : ''; ?>>20</option>
	  <option value='50' <?php echo(isset($R3FF8B17D7B489F8D5572486F5802A6EB))? $R3FF8B17D7B489F8D5572486F5802A6EB : ''; ?>>50</option>
	  <option value='100' <?php echo(isset($R5C739D4F034E5FF353F80BEBC20C3EB8))? $R5C739D4F034E5FF353F80BEBC20C3EB8 : ''; ?>>100</option>
	  <option value='200' <?php echo(isset($R4031CAFBE886B17C5888C881A311C10C))? $R4031CAFBE886B17C5888C881A311C10C : ''; ?>>200</option>
	  <option value='500' <?php echo(isset($R2B5F9EE16B1E79136FFD0F6DCEDCB994))? $R2B5F9EE16B1E79136FFD0F6DCEDCB994 : ''; ?>>500</option>
	</select>
    </div>
	<br/>
	<div class="form-group">
		<label class="sr-only" for="retweetPaging">عدد الحسابات  لكل مجموعه من مجموعات الريتويت/المتابعة </label>
		<select name="retweetPaging" id="retweetPaging" >
	<?php if(isset($R3218BDF9087452EE011F4C7B1585D234)){    switch($R3218BDF9087452EE011F4C7B1585D234){     case '20':      $R4F2F8F1B34AB37469EB865F4B7F91906 ="selected";     break;     case '50':      $R94ABC4762689A0691F967819B9927628 ="selected";     break;     case '100':      $R9E000B69F94063408E85CE7DF7615404 ="selected";     break;     case '200':      $R3BAA8855793096F6FF24F7BEEE4BF4A2 ="selected";     break;     case '500':      $R5F0C2F1630FB68689A45684B4C61544C ="selected";     break;     default:      $R4F2F8F1B34AB37469EB865F4B7F91906 ="selected";     break;    }  }?>

	  <option value='20' <?php echo(isset($R4F2F8F1B34AB37469EB865F4B7F91906))? $R4F2F8F1B34AB37469EB865F4B7F91906 : ''; ?>>20</option>
	  <option value='50' <?php echo(isset($R94ABC4762689A0691F967819B9927628))? $R94ABC4762689A0691F967819B9927628 : ''; ?>>50</option>
	  <option value='100' <?php echo(isset($R9E000B69F94063408E85CE7DF7615404))? $R9E000B69F94063408E85CE7DF7615404 : ''; ?>>100</option>
	  <option value='200' <?php echo(isset($R3BAA8855793096F6FF24F7BEEE4BF4A2))? $R3BAA8855793096F6FF24F7BEEE4BF4A2 : ''; ?>>200</option>
	  <option value='500' <?php echo(isset($R5F0C2F1630FB68689A45684B4C61544C))? $R5F0C2F1630FB68689A45684B4C61544C : ''; ?>>500</option>
	</select>
	
	</div>
	<br/>
	<input type="hidden" name="action" value="settings" />
    <button  type="submit" class="btn btn-default"> حفظ الإعدادات </button>
  
 </form>


 </div>
 </div>
 
<div id="msg"></div>
</div>
<?php   require_once("footer.php"); ?>
</div>
<?php } else      {  echo "<meta http-equiv='refresh' content='0,url=index.php'>"; }   ?>