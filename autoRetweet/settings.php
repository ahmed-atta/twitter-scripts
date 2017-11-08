<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
 session_start();
if(isset($_SESSION['retweet_admin']) && $_SESSION['retweet_admin'] == 1) {
	require_once("header.php");
	require_once('config.php');
	if($osettings = $mysqli->query("SELECT * FROM re_options WHERE option_name ='settings' ")){
		if($osettings->num_rows > 0 ){
			$jsettings = $osettings->fetch_assoc();
			$get_settings = unserialize($jsettings['option_value']);
			$accountsPaging  = $get_settings['accountsPaging'];
			$retweetPaging  = $get_settings ['retweetPaging'];
		}
	}
	
	if(isset($_POST['action'])){
		
		$post_jsettings['accountsPaging'] = $_POST['accountsPaging'];
		$post_jsettings['retweetPaging'] = $_POST['retweetPaging'];
		$post_settings = serialize($post_jsettings);
		$admin_id = $_SESSION['admin_id'];
		if($osettings) {
			if($osettings->num_rows > 0 ){
				$mysqli->query("UPDATE `re_options` SET option_value ='$post_settings' WHERE option_name ='settings' ");
			} else {
				$mysqli->query("INSERT INTO `re_options` (option_name,option_value,admin_id) VALUES ('settings','$post_settings','1');" );
			}
		}
		echo"<br/><center><span class='label label-success'>تم حفظ الإعدادات   </span></center>
				<meta http-equiv='refresh' content='2'>";
		  
			
	}
	
?>
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
	<?php if(isset($accountsPaging)){
			switch($accountsPaging){
				case '20':
					$selected20 ="selected";
				break;
				case '50':
					$selected50 ="selected";
				break;
				case '100':
					$selected100 ="selected";
				break;
				case '200':
					$selected200 ="selected";
				break;
				case '500':
					$selected500 ="selected";
				break;
				default:
					$selected20 ="selected";
				break;
			}
	}?>

	  <option value='20' <?php echo(isset($selected20))? $selected20 : ''; ?>>20</option>
	  <option value='50' <?php echo(isset($selected50))? $selected50 : ''; ?>>50</option>
	  <option value='100' <?php echo(isset($selected100))? $selected100 : ''; ?>>100</option>
	  <option value='200' <?php echo(isset($selected200))? $selected200 : ''; ?>>200</option>
	  <option value='500' <?php echo(isset($selected500))? $selected500 : ''; ?>>500</option>
	</select>
    </div>
	<br/>
	<div class="form-group">
		<label class="sr-only" for="retweetPaging">عدد الحسابات  لكل مجموعه من مجموعات الريتويت/المتابعة </label>
		<select name="retweetPaging" id="retweetPaging" >
	<?php if(isset($retweetPaging)){
			switch($retweetPaging){
				case '20':
					$select20 ="selected";
				break;
				case '50':
					$select50 ="selected";
				break;
				case '100':
					$select100 ="selected";
				break;
				case '200':
					$select200 ="selected";
				break;
				case '500':
					$select500 ="selected";
				break;
				default:
					$select20 ="selected";
				break;
			}
	}?>

	  <option value='20' <?php echo(isset($select20))? $select20 : ''; ?>>20</option>
	  <option value='50' <?php echo(isset($select50))? $select50 : ''; ?>>50</option>
	  <option value='100' <?php echo(isset($select100))? $select100 : ''; ?>>100</option>
	  <option value='200' <?php echo(isset($select200))? $select200 : ''; ?>>200</option>
	  <option value='500' <?php echo(isset($select500))? $select500 : ''; ?>>500</option>
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
<?php	
	require_once("footer.php");
?>
</div>
<?php
} else 
    {  echo "<meta http-equiv='refresh' content='0,url=index.php'>";	}


?>