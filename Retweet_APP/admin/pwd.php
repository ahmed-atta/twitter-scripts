<?php 
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
 session_start();
if(isset($_SESSION['retweet_admin']) && $_SESSION['retweet_admin'] == 1) {
	require_once("header.php");
	require_once('config.php');
	
	if(isset($_POST['action']) && $_POST['action'] == 'save'){
		if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password1'])){
		  $msg = "<br/><center><span class='alert alert-error'>! خطأ .. تأكد من إدخال كل البيانات </span></center>";
		} else if ($_POST['password'] != $_POST['password1']){
			$msg = "<br/><center><span class='alert alert-error'>! خطأ .. كلمة المرور غير متطابقه </span></center>";
		} else {
			$filename = '.dat';
			$fp = fopen($filename, "w+");
			$pwd = $_POST['username'].":".$_POST['password'];
			fputs ($fp,base64_encode($pwd) );
			fclose($fp);
			
			
			$msg = "<div class='alert alert-danger'>تم حفظ الإعدادات   </div><meta http-equiv='refresh' content='2'>";
			
		}	
	} else if(isset($_POST['action']) && $_POST['action'] == 'reset'){
		unlink('.dat');
		$msg = "<div class='alert alert-danger'> تم التراجع للبيانات الإفتراضيه </div><meta http-equiv='refresh' content='2'>";
	}
?>
<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
	<ul class="breadcrumb">
        <li class="active"><b>تغيير بيانات الدخول </b></li>
	</ul>
<div>

<!-- ======================================================================= -->
<?php echo (isset($msg))? $msg :''; ?>

 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
    <div class="form-group">
	<label for="username">اسم الدخول :</label>
	<input type='text' name="username" id="username" />
    </div>
	<br/>
	<div class="form-group">
		<label class="sr-only" for="password">كلمة المرور : </label>
		<input type='password' name="password" id="password" />
	</div>
	<div class="form-group">
		<label class="sr-only" for="password1">تأكيد كلمة المرور : </label>
		<input type='password' name="password1" id="password1" />
	</div>
	<br/>
    <button  type="submit" name="action" value="save"  class="btn btn-default"> حفظ التغييرات </button>
	<button  type="submit" name="action" value="reset" class="btn btn-default"> البيانات الافتراضيه </button>
  
 </form>

 </div>
 </div>
 

</div>
<?php	
	require_once("footer.php");
?>
</div>
<?php
} else 
    {  echo "<meta http-equiv='refresh' content='0,url=index.php'>";	}


?>