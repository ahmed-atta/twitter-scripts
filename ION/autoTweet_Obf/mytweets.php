<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
 @session_start(); if(isset($_SESSION['tweet_admin']) && $_SESSION['tweet_admin'] === 1) {  require_once("header.php");  require_once("config.php");  if(isset($_GET['action'])){   switch($_GET['action']){    case 'del':    {     $R3584859062EA9ECFB39B93BFCEF8E869 = intval($_GET['id']) ;     if(isset($_SESSION['admin_id'])){      $RBB32441668F470FBCC1C73DDEEF24A3A= "DELETE FROM tweets WHERE id = ".$R3584859062EA9ECFB39B93BFCEF8E869;      $R130D64A4AD653C91E0FD80DE8FEADC3A= $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query($RBB32441668F470FBCC1C73DDEEF24A3A);      $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-success'>تم حذف التغريده  </span></center>          <meta http-equiv='refresh' content='0; url=mytweets.php'>";     }    }    break;   }  } ?>

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
    <th>وقت التغريد</th>
	<th>تكرار</th>
	<th>تكرار كل (دقيقة)</th>
    <th> نص التغريده</th>
    <th> تعديلات</th>
    </tr>
    </thead>
    <tbody>
<?php if($R5C347ABF1BBF428B465DC7B760BEE5F9 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM `tweets` ")){  $RA16D2280393CE6A2A5428A4A8D09E354=0;  if($R5C347ABF1BBF428B465DC7B760BEE5F9->num_rows > 0){   while($R4EEB713E57BBAAF1217CF39632604473 = $R5C347ABF1BBF428B465DC7B760BEE5F9->fetch_assoc()){    $RA16D2280393CE6A2A5428A4A8D09E354= $RA16D2280393CE6A2A5428A4A8D09E354+1;    $RD139FDEAF358FBB04DE0743B9904C79B= ($R4EEB713E57BBAAF1217CF39632604473['loop'] == 1)?"نعم":"لا" ;    echo '     <tr>      <td>'.$RA16D2280393CE6A2A5428A4A8D09E354.'</td>     <td>'.$R4EEB713E57BBAAF1217CF39632604473['timestamp'].'</td>     <td>'.$RD139FDEAF358FBB04DE0743B9904C79B.'</td>     <td>'.$R4EEB713E57BBAAF1217CF39632604473['interval'].'</td>     <td width="50%">'.$R4EEB713E57BBAAF1217CF39632604473['tweet'].'</td>      <td><a class="btn btn-danger" href="?action=del&id='.$R4EEB713E57BBAAF1217CF39632604473['id'].'" > حذفها</a> </td>     </tr>      ';   }  } else {   echo "<tr><td colspan='6'>لا توجد تغريدات مجدولة </td></tr>";  } } ?>
    </tbody>
    </table>


 </div>
<div id="msg"></div>
</div>
</div>
<?php } else      {  echo "<meta http-equiv='refresh' content='0;URL=index.php'>"; } ?>