<?php @session_start();
/** 
 * @author AHMED ATTA (parmagy.com)
 * @website http://demos.parmagy.com/twitter
 */
if(empty($_SESSION)) header("Location: index.php");
if(@$_SESSION['retweet_admin'] === 1){
	require './config.php';
	require_once("header.php");
	
	if(isset($_GET['action']) && ($_GET['action'] =='del') && isset($_GET['id'])){
		$id =  $mysqli->real_escape_string($_GET['id']);
		$mysqli->query("DELETE  FROM `re_users`  WHERE  id = '$id'");
		
	}
	if($query_all = $mysqli->query("SELECT  id  FROM `re_users` AS U WHERE U.admin_id = ".$_SESSION['admin_id'])){
		$counts = $query_all->num_rows;
		if($counts > 0){
			$osettings = $mysqli->query("SELECT op.option_value  FROM `re_options` AS op WHERE op.option_name='settings' AND op.admin_id = ".$_SESSION['admin_id']);
			$jsettings = $osettings->fetch_assoc();
			$settings = unserialize($jsettings['option_value']);
			//print_r($settings);
			$accountsPaging  = $settings['accountsPaging'];
			if($counts < $accountsPaging){
				$pages = 1;
			} else {
				if(!isset($accountsPaging) && $accountsPaging < 1)
					echo "<meta http-equiv='refresh' content='0;URL=settings.php'>";
				else 
					$pages =  ceil($counts/$accountsPaging);
			}
		}
	}
	if(isset($_GET['p']) && $_GET['p'] > 1 && $_GET['p'] <= $pages){
					$page = $_GET['p'];
					$limitStart = ($page - 1) * $accountsPaging;
	} else {
		$page = 1;
		$limitStart = 0;
	}
	$limitEnd =  (isset($accountsPaging))? $accountsPaging : 0;
	$pages = (isset($pages))? $pages : 0;
	$result = $mysqli->query("SELECT  U.id ,U.username ,U.screen_name  FROM `re_users` AS U WHERE U.admin_id = '".$_SESSION['admin_id']."' LIMIT $limitStart,$limitEnd");

?>

  <div class="container-fluid">
  <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
	
	  <div class="span9 TESTTTT">
      <ul class="breadcrumb">
        <li class="active"><b>حسابات المشتركين </b></li>
      </ul>
      <center><!-- a  href="login-twitter.php" class="btn btn-danger btn-large Loading-btn" data-loading-text="&lt;b&gt;جارى تسجيل الحساب ...&lt;/b&gt;"> أضف حساب  </a-->
	  <?php echo "<label> عدد حسابات المشتركين  : </label><div>".$counts ."</div>"; ?>
	  </center>
	  <h4> قائمة حسابات المشتركين </h4>
<table class="table table-bordered">
    <thead>
    <tr> 	<th>ID </th>
			<th> الاسم </th>
			<th> اسم تويتر </th>
    </tr>
    </thead>
    <tbody>
<?php  
if ($result) {
    /* fetch associative array */
	$counter = $limitStart;
    while ($row = $result->fetch_assoc()) {
		$counter +=1;
       echo '	<tr><td>'.$counter.'</td>
		<td>'.$row['username'].'</td>
		<td><a href="https://twitter.com/'.$row['screen_name'].'">'.$row['screen_name'].'</a></td>
		<td><a class="btn btn-danger" href="accounts.php?action=del&id='.$row['id'].'"> حذف </a> </td>
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
<style type='text/css'>
span.pages {
    border: 1px solid #0EB2CD;
    color: #FFFFFF;
    float: right;
    margin: 2px;
    padding: 5px 10px 6px;
	border-radius: 3px;
}
</style>

<ul class='pager'>
<li><span class='pages' style="background: none repeat scroll 0 0 #0EB2CD;"><?php echo "صفحة $page من $pages"; ?></span></li>			
<li><form method='GET' action="<?php echo $_SERVER['PHP_SELF'];?>" id='frmPaging'>
<select name="p" id="paging" onchange="javascript: document.getElementById('frmPaging').submit();">
	<?php  
	for($p=1;$p<= $pages;$p++){
		if($page == $p)
			echo"<option value='$p' selected>$p</option>";
		else
			echo"<option value='$p'>$p</option>";
	}
	?>
</select>
	  </form>
	  </li>
</ul>	
    </div>  
<?php  include_once("footer.php"); ?>  
</div>
 </body></html>
<?php  
} else {
 header("Location: index.php");
}
?>