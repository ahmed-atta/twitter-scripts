<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
@session_start(); if(empty($_SESSION)) header("Location: index.php"); if($_SESSION['retweet_admin'] === 1){  require_once("header.php");  require("lib/twitter/twitteroauth.php");  require 'config.php';  if(isset($_POST['action'])){        $RBCF5E9AF6ADD72227FE808798E77C560 = $_POST['twitter_name'];     $RA4670B6CC8C17F77F7FE39EC1B8564DA = $_POST['accounts_number'];     $R586C95D01BAFEDA06558F8F03C4CF837 = $_POST['forTweet'];     $R0C3852F45107BFF4BC4396961D2C2640 = (isset($_POST['actionType_R']) && $_POST['actionType_R'] == "R")?'R':false;     $RFE7BC0768AEBA68A039992B03F9E9C05 = (isset($_POST['actionType_F']) && $_POST['actionType_F'] == "F")?'F':false;     if($R0C3852F45107BFF4BC4396961D2C2640 && $RFE7BC0768AEBA68A039992B03F9E9C05) {      $R65DFACB39960C22313740A131148FB81 = 'RF';     }else if($R0C3852F45107BFF4BC4396961D2C2640){      $R65DFACB39960C22313740A131148FB81 = 'R';     }else{      $R65DFACB39960C22313740A131148FB81 = 'F';      }     $RE91192A00FF990477EE414AD5D708F08 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("INSERT INTO `re_auto` (`twitter_account`,`type`,`admin_id`,`counts`,`forT`)      VALUES ('$RBCF5E9AF6ADD72227FE808798E77C560','$R65DFACB39960C22313740A131148FB81',1,$RA4670B6CC8C17F77F7FE39EC1B8564DA,'$R586C95D01BAFEDA06558F8F03C4CF837');");        $RDD95BBEC198B2C577F5B3E60A5984492= "<br/><center><span class='label label-success'> سيتم عمل ريتويت/مفضله تلقائي لهذا الحساب  </span></center>     <meta http-equiv='refresh' content='1'>"; } if(isset($_GET['action']) && $_GET['action'] == 'del'){  $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("DELETE  FROM `re_auto`  WHERE  id=".$_GET['id']);  $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-warning'> تم حذف الحساب   </span></center>     <meta http-equiv='refresh' content='1;URL=auto-retweet.php'>"; }  ?>
<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
   <ul class="breadcrumb">
        <li class="active"><b>الريتويت التلقائي</b></li>
      </ul>
 <div class="alert alert-info"><b>(اجعل حساباتك تعمل ريتويت هذا الحساب  تلقائياً)</b></div>
<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
  
    <div class="form-group">
	<label>حساب تويتر : </label>
	<br/>
		<div class="input-group">
			<input type="text" name="twitter_name" class="form-control" placeholder="Username" style="text-align:left;" dir="ltr">
			<span class="input-group-addon">@</span>
		</div>
    </div>
	<br/>
	<div class="alert alert-info"> (عدد الحسابات التي تريدأن يعملوا ريتويت لهذا الحساب)
		وعند ترك الحقل فارغ كل حساباتك ستعمل ريتويت لهذا الحساب
		</div>
	<div class="form-group">
		
		<span class="label label-success"></span>
		<label class="sr-only" for="exampleInput2">عدد الحسابات :</label>
		<input type="text" class="form-control" name="accounts_number" id="exampleInput2" placeholder="عدد الحسابات">
	</div>
	<br/>
	<div class="form-group" style="float:right">
		<label class="sr-only" for="exampleInput2">تريد عمل ريتويت / المفضلة  :</label>
		<label class="checkbox-inline"><input type="checkbox" name="actionType_R" id="inlineCheckbox1" value="R"> ريتــويت</label>
		<label class="checkbox-inline"><input type="checkbox" name="actionType_F" id="inlineCheckbox2" value="F"> المفضلة</label>
	</div>
	<select name="forTweet" style='float:left'>
	  <option  value="T">لتغريدات الحساب</option>
	  <option value="F">المفضلة الخاصة بالحساب</option>
	</select>
	<br style="clear:both"/>
	<br/>
	<input type="hidden" name="action" value="retweet" />
    <button  type="submit" class="btn btn-default">ريتويت/مفضله تلقائياً لهذا الحساب </button>
  
 </form>
</div>
<hr/>
<span id='msg'><?php echo (isset($RDD95BBEC198B2C577F5B3E60A5984492))? $RDD95BBEC198B2C577F5B3E60A5984492:''; ?></span> 
<h3> حساب الريتويت التلقائي </h3>
   <table class="table table-bordered">
    <thead>
    <tr>
	<th>#</th>
	<th> اسم تويتر </th>
	<th> ريتويت/مفضله </th>
	<th>عدد الحسابات  </th>
	<th> سيتم العمل على </th>
    </tr>
    </thead>
    <tbody>
<?php   if ($R44DC647B4FBD7143BC8841A4B65FCC39 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT  *  FROM `re_auto` ")) {       $RD28D446683EE6C382E1E3AF11EE8ED68 = 0;  while($RCA1D851200C68582D1C71A27DF048EC4 = $R44DC647B4FBD7143BC8841A4B65FCC39->fetch_assoc()){    $RD28D446683EE6C382E1E3AF11EE8ED68 +=1;    switch($RCA1D851200C68582D1C71A27DF048EC4['type']){     case 'R':      $R2B1778FFF9C93EE63F71A4FF439B0BEF= "ريتويت";     break;     case 'F':      $R2B1778FFF9C93EE63F71A4FF439B0BEF= "مفضله";     break;     case 'RF':      $R2B1778FFF9C93EE63F71A4FF439B0BEF= "ريتويت/مفضلة";     break;     default:     $R2B1778FFF9C93EE63F71A4FF439B0BEF = '---';    }    switch($RCA1D851200C68582D1C71A27DF048EC4['forT']){     case 'T':      $R7BD4E5D2031CAF340A6AD160EBFFC0A7= "تغريدات الحساب";     break;     case 'F':      $R7BD4E5D2031CAF340A6AD160EBFFC0A7= "مفضلة الحساب";     break;     default:     $R7BD4E5D2031CAF340A6AD160EBFFC0A7 = '---';    }    echo '<tr><td>'.$RD28D446683EE6C382E1E3AF11EE8ED68.'</td>';    echo '<td><a href="https://twitter.com/'.$RCA1D851200C68582D1C71A27DF048EC4["twitter_account"].'">'.$RCA1D851200C68582D1C71A27DF048EC4["twitter_account"].'</a></td>';    echo '<td>'.$R2B1778FFF9C93EE63F71A4FF439B0BEF.'</td>';    echo '<td>'.$RCA1D851200C68582D1C71A27DF048EC4["counts"].'</td>';    echo '<td>'.$R7BD4E5D2031CAF340A6AD160EBFFC0A7.'</td>';    echo '<td><a class="btn btn-danger" href="?action=del&id='.$RCA1D851200C68582D1C71A27DF048EC4["id"].'"> حذف </a> </td>     </tr>';  }             $R44DC647B4FBD7143BC8841A4B65FCC39->free(); } $R0DADB0D8CA9669A3F9F73A406CB0A0FC->close(); ?>
</table>
</div> 
</div>
<?php  require_once("footer.php"); ?>
</div>
<?php  } else {  session_destroy();  header("Location: index.php"); }  ?>