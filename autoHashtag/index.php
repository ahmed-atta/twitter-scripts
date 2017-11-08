<?php session_start();
/** 
 * @author AHMED ATTA (parmagy.com)
 * @email  a.developer@hotmail.com
 * @website http://demos.parmagy.com/twitter
 */
if(isset($_POST['login'])){
	require './config.php';
	$username = mysqli_real_escape_string ( $mysqli , $_POST['username'] );
	$password = mysqli_real_escape_string ( $mysqli , $_POST['password']);

	$row['username'] = $Admin;
	$row['password'] = $Password;
	$row['id'] = 1;
	if($username == $row['username'] && $password == $row['password']){

		$_SESSION['hashtag_admin'] = 1;
		$_SESSION['username'] = $row['username'];
		$_SESSION['admin_id'] = $row['id'];
		header("Location:index.php");
		
	}else {
		$msg = " <div class='alert alert-danger'>البيانات غير صحيحه</div>  ";
	}
} 

if(@$_SESSION['hashtag_admin'] === 1){
	require './config.php';
	
//Username &  Password
	if(isset($_GET['go'])){
		switch($_GET['go']){
			case 'logout':
			{
				session_destroy ();
				@header('Location: index.php '); 
				echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
			} break;
			default:
			 @header("Location: index.php");
		}
	}else {
		@header("Location: accounts.php");
		echo "<meta http-equiv='refresh' content='0;URL=accounts.php'>";
	}
	
	?>
	</div>
</div>
<?php
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<title>لوحة التحكم | تسجيل الدخول</title>
<meta http-equiv="content-language" content="ar">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/dashboard.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="icons/favicon.ico">
<link rel="icon" type="image/x-icon" href="icons/favicon.ico">
<!--[if lt IE 9]><script src="bootstrap/js1/html5shiv.js"></script><![endif]-->
<style type="text/css">
@font-face{font-family:'Droid Arabic Kufi';src:url('bootstrap/fonts/DroidKufi_Regular.ttf');}
body{
	font :11px 'Droid Arabic Kufi';
	background-color:#f5f5f5;
	direction:rtl;
	max-width:760px;
	margin:0 auto;
}
.hr{margin:30px auto 20px auto;border-top:1px solid #D6D6D6;}
</style>
</head>
<body class="bg-gray">
 
<div class="login-area" style="width: 280px;border: 1px solid #B1B1B1;direction:rtl; padding: 20px;border-radius: 6px;box-shadow: 0px 0px 6px #D1D1D1;">
      <img src='images/logo.png' style="margin:-20px 50px"/>
	<?php echo(isset($msg))? $msg : ''; ?> 
	<form  id="UserLoginForm" method="post" accept-charset="utf-8">
	 
	<div class="form-group">
        <div class="input text">
		<div class="col-lg-12 input-group">
		<input name="username" class="form-control" placeholder="إسم المستخدم" maxlength="255" type="text" value="" id="UserUsername">
		<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span></div></div>    </div>
    <div class="form-group">
        <div class="input password"><div class="col-lg-12 input-group">
		<input name="password" class="form-control" placeholder="كلمة المرور" type="password" value="" id="UserPassword">
		<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span></div>
		</div>    
	</div>
    <div class="form-group">
        <div class="submit"><input class="btn btn-success large" type="submit" value="دخــــول" name="login"></div>    
	</div>
    <hr style="border-top:1px solid #A8A8A8">
 
    	
   </form></div>
    <hr class="hr">
    <footer><p></p><center><b>© برمجة  <a href="http://parmagy.com" dir="ltr">parmagy.com</a></b></center><p></p></footer>

</body></html>
<?php
}
?>