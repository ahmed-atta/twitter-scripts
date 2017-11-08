<?php @session_start();
/** 
 * @author AHMED ATTA (parmagy.com)
 * @website http://demos.parmagy.com/twitter
 */
if(empty($_SESSION)) header("Location: index.php");
if(@$_SESSION['tweet_admin'] === 1){
	require_once("header.php");
	require './config.php';
	
	if(isset($_GET['action']) && ($_GET['action'] =='del') && isset($_GET['id'])){
		$id =  $mysqli->real_escape_string($_GET['id']);
		$mysqli->query("DELETE  FROM `users`  WHERE  id = '$id'");
		$mysqli->query("DELETE  FROM `follows`  WHERE  user_id = '$id'");
	}
	if($result = $mysqli->query("SELECT  *  FROM `users`")){
		$counts = $result->num_rows;
	}
?>

  <div class="container-fluid">
  <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
	
	  <div class="span9 TESTTTT">
      <ul class="breadcrumb">
        <li class="active"><b>إضافة حساب</b></li>
      </ul>
      <div class="alert alert-info"><b></b></div>
      <center><a  href="login-twitter.php" class="btn btn-danger btn-large Loading-btn" data-loading-text="&lt;b&gt;جارى تسجيل الحساب ...&lt;/b&gt;"> أضف حساب  </a>
	  <?php echo "<label> عدد حساباتك  : </label><div>".$counts ."</div>"; ?>
	  </center>
	  <h3> حساباتك </h3>
<table class="table table-bordered">
    <thead>
    <tr> 	<th>ID </th>
			<th> الاسم </th>
			<th> اسم تويتر </th>
			<th> يتابع </th>
    </tr>
    </thead>
    <tbody>
<?php  
if ($result) {
    /* fetch associative array */
	$counter = 0;
    while ($row = $result->fetch_assoc()) {
		$counter +=1;
       echo '	<tr><td>'.$counter.'</td>
		<td>'.$row['username'].'</td>
		<td><a href="https://twitter.com/'.$row['screen_name'].'">'.$row['screen_name'].'</a></td>
		<td>'.$row['friends_count'].'</td>
		<td><a class="btn btn-danger" href="accounts.php?action=del&id='.$row['id'].'"> حذف </a> </td>
		</tr>';
    }
}
/* close connection */
$mysqli->close();
?>
    </tbody>
    </table>

    </div>
  </div>
  </div>
<?php  
} else {
 header("Location: index.php");
}


?>