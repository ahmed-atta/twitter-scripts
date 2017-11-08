<?php
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
 session_start();
if(isset($_SESSION['tweet_admin']) && $_SESSION['tweet_admin'] === 1) {
 require_once("header.php");
 require_once("config.php");
	if(isset($_GET['action'])){
		switch($_GET['action']){
			case 'del':
			{
				$id = intval($_GET['id']) ;
				if(isset($_SESSION['tweet_admin'])){
					$sqli= "DELETE FROM `follows` WHERE id = ".$id;
					$sql= $mysqli->query($sqli);
					$msg = "<br/><center><span class='label label-success'>تم حذف الحساب  </span></center>
							  <meta http-equiv='refresh' content='1; url=mytweets.php'>";
				}
			}
			break;
		}
	}
?>

<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
<ul class="breadcrumb">
        <li class="active"><b>أرشيف المتابعات  </b></li>
      </ul>
<div>
 
  <table class="table table-bordered">
    <thead>
    <tr>
	<th>#</th>
		<th>حسابك </th>
	<th>حساب المتابعات </th>
	<th>عدد المتابعات </th>
	<th>يتابع الآن</th>
	<th>البدايه من </th>
	<th>ينتهي بعد </th>
   
    </tr>
    </thead>
    <tbody>
<?php
if($tweetsU = $mysqli->query("SELECT follows.*,users.screen_name,users.friends_count_n FROM `follows`,`users` WHERE follows.user_id = users.id ")){
	$i=0;
	if($tweetsU->num_rows > 0){
		while($row = $tweetsU->fetch_assoc()){
			$i= $i+1;
			echo '
				<tr> 
				<td>'.$i.'</td>
				<td><a href="https://twitter.com/'.$row['screen_name'].'">'.$row['screen_name'].'</a></td>
				<td><a href="https://twitter.com/'.$row['account_f'].'">'.$row['account_f'].'</a></td>
				<td>' .$row['f_count']. '</td>
				<td>' .$row['friends_count_n']. '</td>
				<td>' .$row['timestamp']. '</td>
				<td>' .$row['unfollow']. ' يوم </td>
				 <td><a class="btn btn-danger" href="?action=del&id='.$row['id'].'" > حذف</a> </td>
				</tr>	
				';
		}
	} else {
		echo "<tr><td colspan='6'>لا توجد حسابات بالمتابعات  </td></tr>";
	}
}
?>
    </tbody>
    </table>


 </div>
<div id="msg"></div>
</div>
</div>
<?php
} else 
    {  echo "<meta http-equiv='refresh' content='0;URL=index.php'>";	}
?>