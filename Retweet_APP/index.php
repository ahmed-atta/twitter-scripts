<?php if(isset($_GET['f']) && $_GET['f'] ==1) {
		$msg = "<div class='alert alert-danger'> شكرا  لك . تم الإشتراك بالتطبيق بنجاح </div>";
}
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
<title>Parmagy.com | خدمة الريتويت</title>

<meta http-equiv="content-language" content="ar">
<meta name="author" content="parmagy.com">
<meta name="copyright" content="parmagy.com">
<link href="./admin/css/style.css" rel="stylesheet">
</head>
<body>
  <div class="container-fluid">
  <div>
	<div style="width: 70%;background-color: #fff; border: 1px solid #e5e5e5;border-radius: 6px;box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067); padding: 10px;margin:0 auto;">
      <ul class="breadcrumb">
        <li class="active"><b>إشترك معنا</b></li>
      </ul>
	  <?php echo (isset($msg))? $msg : ''; ?>
	  <center><img src="./images/7L.png" /></center><br/><br/>
      <center><a href="login-twitter.php" class="btn btn-danger btn-large Loading-btn" data-loading-text="&lt;b&gt;جارى تسجيل الحساب ...&lt;/b&gt;"> اشترك معنا  </a></center>
    </div>
  </div>
  </div> 
	<hr>
   <footer><!-- center><b>© برمجة  <a href="http://parmagy.com/" dir="ltr">parmagy.com</a></b></center--></footer>
</body></html>