<?php
/** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  info@parmagy.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/
session_start(); if(isset($_SESSION['hashtag_admin']) && $_SESSION['hashtag_admin'] === 1) {  require_once("config.php");  if(isset($_GET['action'])){   switch($_GET['action']){    case 'del':    {     $R3584859062EA9ECFB39B93BFCEF8E869 = intval($_GET['id']) ;      $RBB32441668F470FBCC1C73DDEEF24A3A= "DELETE FROM tweets WHERE id = ".$R3584859062EA9ECFB39B93BFCEF8E869;      $R130D64A4AD653C91E0FD80DE8FEADC3A= $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query($RBB32441668F470FBCC1C73DDEEF24A3A);      $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-success'>تم حذف التغريده  </span></center>          <meta http-equiv='refresh' content='1; url=mytweets.php'>";         }    break;   }  } ?>
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
<?php if($R5C347ABF1BBF428B465DC7B760BEE5F9 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM `tweets` ")){  $RA16D2280393CE6A2A5428A4A8D09E354=0;  if($R5C347ABF1BBF428B465DC7B760BEE5F9->num_rows > 0){   while($R4EEB713E57BBAAF1217CF39632604473 = $R5C347ABF1BBF428B465DC7B760BEE5F9->fetch_assoc()){    $RA16D2280393CE6A2A5428A4A8D09E354= $RA16D2280393CE6A2A5428A4A8D09E354+1;    switch($R4EEB713E57BBAAF1217CF39632604473['hashtag_location']){        case 'sa':          $R0FC694E85343C291F53770941ABC26F0 = "المملكة العربية السعودية";         break;        case 'eg':         $R0FC694E85343C291F53770941ABC26F0 = "جمهورية مصر العربيه";         break;        case 'kw':         $R0FC694E85343C291F53770941ABC26F0 = "الكويت";          break;        case 'ae':         $R0FC694E85343C291F53770941ABC26F0 = "الإمارات";          break;        case 'qa':         $R0FC694E85343C291F53770941ABC26F0 = "قطر";          break;        case 'bh':         $R0FC694E85343C291F53770941ABC26F0 = "البحرين";          break;        default:       }    echo "<tr>      <td>".$RA16D2280393CE6A2A5428A4A8D09E354."</td>     <td width='50%'>".$R4EEB713E57BBAAF1217CF39632604473['tweet']."</td>     <td>$R0FC694E85343C291F53770941ABC26F0</td>      <td><a class='btn btn-danger' href='?action=del&id=".$R4EEB713E57BBAAF1217CF39632604473['id']."' > حذفها</a> </td>     </tr>";   }  } else {   echo "<tr><td colspan='6'>لا توجد تغريدات مجدولة </td></tr>";  } } ?>
    </tbody>
    </table>


 </div>
<div id="msg"></div>
</div>
</div>
<?php } else      {  echo "<meta http-equiv='refresh' content='0;URL=index.php'>"; } ?>