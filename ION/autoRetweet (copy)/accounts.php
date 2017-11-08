<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
 @session_start();  if(empty($_SESSION)) header("Location: index.php"); if(@$_SESSION['retweet_admin'] === 1){  require_once("header.php");  require './config.php';    if(isset($_GET['action']) && ($_GET['action'] =='del') && isset($_GET['id'])){   $R3584859062EA9ECFB39B93BFCEF8E869 =  $R0DADB0D8CA9669A3F9F73A406CB0A0FC->real_escape_string($_GET['id']);   $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("DELETE  FROM `re_users`  WHERE  id = '$R3584859062EA9ECFB39B93BFCEF8E869'");  }  if($R679E9B9234E2062F809DBD3325D37FB6 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT  *  FROM `re_users`")){   $RA4670B6CC8C17F77F7FE39EC1B8564DA = $R679E9B9234E2062F809DBD3325D37FB6->num_rows;  }  $RA4670B6CC8C17F77F7FE39EC1B8564DA = (isset($RA4670B6CC8C17F77F7FE39EC1B8564DA))? $RA4670B6CC8C17F77F7FE39EC1B8564DA : ''; ?>

  <div class="container-fluid">
  <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
	
	  <div class="span9 TESTTTT">
      <ul class="breadcrumb">
        <li class="active"><b>إضافة حساب</b></li>
      </ul>
      <center><a  href="login-twitter.php" class="btn btn-danger btn-large Loading-btn" data-loading-text="&lt;b&gt;جارى تسجيل الحساب ...&lt;/b&gt;"> أضف حساب  </a>
	  <?php echo "<label> عدد حساباتك  : </label><div>".$RA4670B6CC8C17F77F7FE39EC1B8564DA ."</div>"; ?>
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
<?php   if ($R679E9B9234E2062F809DBD3325D37FB6) {       $RD28D446683EE6C382E1E3AF11EE8ED68 = 0;     while ($R4EEB713E57BBAAF1217CF39632604473 = $R679E9B9234E2062F809DBD3325D37FB6->fetch_assoc()) {   $RD28D446683EE6C382E1E3AF11EE8ED68 +=1;        echo ' <tr><td>'.$RD28D446683EE6C382E1E3AF11EE8ED68.'</td>   <td>'.$R4EEB713E57BBAAF1217CF39632604473['username'].'</td>   <td><a href="https://twitter.com/'.$R4EEB713E57BBAAF1217CF39632604473['screen_name'].'">'.$R4EEB713E57BBAAF1217CF39632604473['screen_name'].'</a></td>   <td><a class="btn btn-danger" href="accounts.php?action=del&id='.$R4EEB713E57BBAAF1217CF39632604473['id'].'"> حذف </a> </td>   </tr>';     }           $R679E9B9234E2062F809DBD3325D37FB6->free(); }  $R0DADB0D8CA9669A3F9F73A406CB0A0FC->close(); ?>
    </tbody>
    </table>

    </div>
  </div>
  </div>
<?php   } else {  header("Location: index.php"); } ?>