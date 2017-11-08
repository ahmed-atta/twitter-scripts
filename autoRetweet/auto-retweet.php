<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @website http://demos.parmagy.com/twitter
 */
session_start();
if(empty($_SESSION)) header("Location: index.php");
if(@$_SESSION['retweet_admin'] === 1){
	require_once("header.php");
	require("lib/twitter/twitteroauth.php");
	require 'config.php';

if(isset($_POST['action'])){
		#Insert a new Record
				$twitter_name = $_POST['twitter_name'];
				$counts = $_POST['accounts_number'];
				$forTweet = $_POST['forTweet'];
				$r_type = (isset($_POST['actionType_R']) && $_POST['actionType_R'] == "R")?'R':false;
				$f_type = (isset($_POST['actionType_F']) && $_POST['actionType_F'] == "F")?'F':false;
				if($r_type && $f_type) {
					$type = 'RF';
				}else if($r_type){
					$type = 'R';
				}else{
					$type = 'F';	
				}
				$query = $mysqli->query("INSERT INTO `re_auto` (`twitter_account`,`type`,`admin_id`,`counts`,`forT`) 
				VALUES ('$twitter_name','$type',1,$counts,'$forTweet');");
				
		$msg= "<br/><center><span class='label label-success'> سيتم عمل ريتويت/مفضله تلقائي لهذا الحساب  </span></center>
				<meta http-equiv='refresh' content='1'>";
}
if(isset($_GET['action']) && $_GET['action'] == 'del'){
	$mysqli->query("DELETE  FROM `re_auto`  WHERE  id=".$_GET['id']);
	$msg = "<br/><center><span class='label label-warning'> تم حذف الحساب   </span></center>
				<meta http-equiv='refresh' content='1;URL=auto-retweet.php'>";
}
//==============================================================//
?>
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
<span id='msg'><?php echo (isset($msg))? $msg:''; ?></span> 
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
<?php  
if ($rs_retweet = $mysqli->query("SELECT  *  FROM `re_auto` ")) {
    /* fetch associative array */
	$counter = 0;
	while($account = $rs_retweet->fetch_assoc()){
			$counter +=1;
			switch($account['type']){
				case 'R':
					$rftype= "ريتويت";
				break;
				case 'F':
					$rftype= "مفضله";
				break;
				case 'RF':
					$rftype= "ريتويت/مفضلة";
				break;
				default:
				$rftype = '---';
			}
			switch($account['forT']){
				case 'T':
					$fort= "تغريدات الحساب";
				break;
				case 'F':
					$fort= "مفضلة الحساب";
				break;
				default:
				$fort = '---';
			}
			echo '<tr><td>'.$counter.'</td>';
			echo '<td><a href="https://twitter.com/'.$account["twitter_account"].'">@'.$account["twitter_account"].'</a></td>';
			echo '<td>'.$rftype.'</td>';
			echo '<td>'.$account["counts"].'</td>';
			echo '<td>'.$fort.'</td>';
			echo '<td><a class="btn btn-danger" href="?action=del&id='.$account["id"].'"> حذف </a> </td>
			 </tr>';
	}
	
	
    /* free result set */
   $rs_retweet->free();
}
$mysqli->close();
?>
</table>
</div> 
</div>
<?php
	require_once("footer.php");
?>
</div>
<?php	
} else {
	session_destroy();
	header("Location: index.php");
}

?>