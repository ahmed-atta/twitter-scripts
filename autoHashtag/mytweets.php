<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
 session_start();
if(isset($_SESSION['hashtag_admin']) && $_SESSION['hashtag_admin'] === 1) {
 require_once("config.php");
	if(isset($_GET['action'])){
		switch($_GET['action']){
			case 'del':
			{
				$id = intval($_GET['id']) ;
					$sqli= "DELETE FROM tweets WHERE id = ".$id;
					$sql= $mysqli->query($sqli);
					$msg = "<br/><center><span class='label label-success'>تم حذف التغريده  </span></center>
							  <meta http-equiv='refresh' content='1; url=mytweets.php'>";
				
			}
			break;
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
	 <th> الهاشتاجات المتداوله في دولة</th>
    <th> تعديلات</th>
    </tr>
    </thead>
    <tbody>
<?php
if($tweetsU = $mysqli->query("SELECT * FROM `tweets` ")){
	$i=0;
	if($tweetsU->num_rows > 0){
		while($row = $tweetsU->fetch_assoc()){
			$i= $i+1;
			switch($row['hashtag_location']){
							case 'sa': 
								$woeid = "المملكة العربية السعودية";
								break;
							case 'eg':
								$woeid = "جمهورية مصر العربيه";
								break;
							case 'kw':
								$woeid = "الكويت"; 
								break;
							case 'ae':
								$woeid = "الإمارات"; 
								break;
							case 'qa':
								$woeid = "قطر"; 
								break;
							case 'bh':
								$woeid = "البحرين"; 
								break;
							default:
						}
			echo "<tr> 
				<td>".$i."</td>
				<td width='50%'>".$row['tweet']."</td>
				<td>$woeid</td>
				 <td><a class='btn btn-danger' href='?action=del&id=".$row['id']."' > حذفها</a> </td>
				</tr>";
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
</div>
<?php
} else 
    {  echo "<meta http-equiv='refresh' content='0;URL=index.php'>";	}
?>