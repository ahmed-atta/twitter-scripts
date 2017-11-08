<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
 session_start();
if(isset($_SESSION['retweet_admin']) && $_SESSION['retweet_admin'] === 1) {
 require_once("header.php");
 require_once("config.php");
	if(isset($_GET['action'])){
		switch($_GET['action']){
			case 'del':
			{
				$id = intval($_GET['id']) ;
				if(isset($_SESSION['admin_id'])){
					$sqli= "DELETE FROM re_tweets WHERE id = ".$id;
					$sql= $mysqli->query($sqli);
					$msg = "<br/><center><span class='label label-success'>تم حذف التغريده  </span></center>
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
        <li class="active"><b>التغريدات المجدولة</b></li>
      </ul>
<div>
 
  <table class="table table-bordered">
    <thead>
    <tr>
	<th>#</th> 
	<th> نص التغريده</th>
    <th>وقت التغريد</th>
	<th>تكرار</th>
	<th>تكرار كل (دقيقة)</th>
	<th> نشر بالهاشتاجات </th>
	<th> تم التغريد </th>
    <th> تعديلات</th>
    </tr>
    </thead>
    <tbody>
<?php
if($tweetsU = $mysqli->query("SELECT * FROM `re_tweets` WHERE admin_id= ".$_SESSION['admin_id'])){
	$i=0;
	if($tweetsU->num_rows > 0){
		while($row = $tweetsU->fetch_assoc()){
			$i= $i+1;
			$loop = ($row['loop'] == 1)?"نعم":"لا" ;
			$status = ($row['status'] == 1)?"نعم":"لا" ;
			$hashtag = ($row['is_hashtag'] == 1)?"نعم":"لا" ;
			echo '
				<tr> 
				<td>'.$i.'</td>		
				<td width="50%">'.$row['tweet'].'</td>
				<td>'.$row['timestamp'].'</td>
				<td>'.$loop.'</td>
				<td>'.$row['interval'].'</td>
				<td>'.$hashtag.'</td>
				<td style="color:red">'.$status.'</td>
		
				 <td><a class="btn btn-danger" href="?action=del&id='.$row['id'].'" > حذفها</a> </td>
				</tr>	
				';
		}
	} else {
		echo "<tr><td colspan='6'>لا توجد تغريدات مجدولة </td></tr>";
	}
}
?>
    </tbody>
    </table>


 </div>
<div id="msg"></div>
</div>

<?php	
	require_once("footer.php");
?>
</div>
<?php
} else 
    {  echo "<meta http-equiv='refresh' content='0;URL=index.php'>";	}
?>