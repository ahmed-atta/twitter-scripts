<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @website http://demos.parmagy.com/twitter
 */
session_start();
if(empty($_SESSION)) header("Location: index.php");
if(@$_SESSION['admin'] === 1){
	require_once("header.php");
	require("lib/twitter/twitteroauth.php");
	require 'config.php';
		if(isset($_GET['action']) && $_GET['action'] =='del'){
						$reply_id = $mysqli->real_escape_string(strip_tags($_GET['id']));
						
						$mysqli->query("DELETE FROM replies WHERE `id`=".$_GET['id']);
						$msg = "<br/><center><span class='label label-success'> تم الحذف </span></center>
						<meta http-equiv='refresh' content='1,URL=auto-reply.php'>";
				  
		} 
		if(isset($_POST['action'])){
					if(isset($_POST['uid']) && !empty($_POST['uid'])){
						$tweet = $mysqli->real_escape_string(strip_tags($_POST['tweet']));
						$screen_name = $mysqli->real_escape_string(strip_tags($_POST['screen_name'])); 
						
						//$comma_separated = implode(",", $_POST['uids']);
						//$user_id = $comma_separated;
						$user_id = $_POST['uid'];
						$mysqli->query("INSERT INTO replies (`tweet`,`screen_name`,`user_id`) VALUES
						('$tweet','$screen_name',$user_id);");
						
						$msg = "<br/><center><span class='label label-success'> تم إضافة الحساب  </span></center>
						<meta http-equiv='refresh' content='1'>";
					}
		} else {
			//$msg = "<br/><center><span class='label label-success'> عذرا لا يمكن إضافة أكثر من حساب !!!! </span></center>";
		}
//==============================================================//
?>
<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
   <ul class="breadcrumb">
        <li class="active"><b>الرد التلقائي </b></li>
      </ul>
 <div class="alert alert-info"><b>(اجعل حساباتك ترد على هذا الحساب تلقائياً)</b></div>
<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
  
    <div class="form-group">
	<label>حدد حساب من المشاهير : </label>
		<div class="input-group">
			<input type="text" name="screen_name" class="form-control" placeholder="Username" style="text-align:left;" dir="ltr">
			<span class="input-group-addon">@</span>
		</div>
    </div>
	<br/>
	<label>حدد تغريدة الرد  :</label><textarea rows="3" class="input-xxlarge " id="tw"  name="tweet" placeholder="غرد هنا" ></textarea>
	<br/><br/>
	<div class="alert alert-info"> (اختر حساباتك التي ترد على الحساب)</div>
	<h4>اختر من حساباتك  </h4>
<table class="table table-bordered">
    <thead>
    <tr> 	<th>ID </th>
			<th> الاسم </th>
			<th> اسم تويتر </th>
    </tr>
    </thead>
    <tbody>
<?php  
if ($result = $mysqli->query("SELECT  *  FROM `users`")) {
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

?>
    </tbody>
    </table>
	<br/>
	<input type="hidden" name="action" value="retweet" />
    <button  type="submit" class="btn btn-default">أضف إلى القائمة </button>
  
 </form>
</div>

<hr/>
<span id='msg'><?php echo (isset($msg))? $msg :''; ?></span> 
<h4>قائمة حسابات الرد على المشاهير </h4>
   <table class="table table-bordered">
    <thead>
    <tr>
	<th>اسم تويتر</th>
	<th> التغريده </th>
	<th> </th>
    </tr>
    </thead>
    <tbody>
<?php  
if($reply_q = $mysqli->query("SELECT * FROM replies")){
				$reply_count = $reply_q->num_rows;
				if($reply_count > 0){
				while($row = $reply_q->fetch_assoc()){
					echo "<tr><td><a href='https://twitter.com/".$row['screen_name']."'>".
					$row['screen_name']."@</a></td><td width='65%'>".$row['tweet']."</td>";
					echo "<td><a class='btn btn-danger' href='?action=del&id=".$row['id']."'> حذف </a> </td></tr>";
					}
				}
			}
$mysqli->close();
?>
</table>
</div> 
</div>
</div>
<?php	
} else {
	session_destroy();
	header("Location: index.php");
}

?>