<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
 session_start(); if(isset($_SESSION['retweet_admin']) && $_SESSION['retweet_admin'] == 1) {  require_once("header.php");  require_once('config.php');    if(isset($_POST['action']) && $_POST['action'] == 'save'){   if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password1'])){     $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='alert alert-error'>! خطأ .. تأكد من إدخال كل البيانات </span></center>";   } else if ($_POST['password'] != $_POST['password1']){    $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='alert alert-error'>! خطأ .. كلمة المرور غير متطابقه </span></center>";   } else {    $R3656889A448A7AF799D2D7955BED2354 = '.dat';    $RF500F4A848E2EB2F8AAC3A6734D7EC38 = fopen($R3656889A448A7AF799D2D7955BED2354, "w+");    $RD5F59C5C648EB3B3575AE9EFC975AC7B = $_POST['username'].":".$_POST['password'];    fputs ($RF500F4A848E2EB2F8AAC3A6734D7EC38,base64_encode($RD5F59C5C648EB3B3575AE9EFC975AC7B) );    fclose($RF500F4A848E2EB2F8AAC3A6734D7EC38);    $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-success'>تم حفظ الإعدادات   </span></center>     <meta http-equiv='refresh' content='2'>";       }   } else if(isset($_POST['action']) && $_POST['action'] == 'reset'){   unlink('.dat');   $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-success'>تم التراجع للبيانات الإفتراضيه </span></center>     <meta http-equiv='refresh' content='2'>";  } ?>
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
<div id="msg"><?php echo (isset($RDD95BBEC198B2C577F5B3E60A5984492))? $RDD95BBEC198B2C577F5B3E60A5984492 :''; ?></div>

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
<?php   require_once("footer.php"); ?>
</div>
<?php } else      {  echo "<meta http-equiv='refresh' content='0,url=index.php'>"; }   ?>