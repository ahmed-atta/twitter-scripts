<?php /** 
 * @author AHMED ATTA (parmagy.com)
 * @email  info@parmagy.com
 * @website http:/Tweety-Ar.com/
 */
session_start();
if($_SESSION['hashtag_admin'] === 1){
	require './config.php';
	
	if(isset($_GET['action']) && ($_GET['action'] =='del') && isset($_GET['id'])){
		$id =  $mysqli->real_escape_string($_GET['id']);
		$mysqli->query("DELETE  FROM `users`  WHERE  id = '$id'");
	}
	if($result = $mysqli->query("SELECT  *  FROM `users`")){
		$counts = $result->num_rows;
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

    </div>
  </div>
  </body></html>
<?php  
} else {
 header("Location: index.php");
 echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
}
?>