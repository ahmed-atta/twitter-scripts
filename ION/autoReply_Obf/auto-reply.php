<?php /** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  a.developer@hotmail.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/ 
session_start(); if(empty($_SESSION)) header("Location: index.php"); if(@$_SESSION['admin'] === 1){  require_once("header.php");  require("lib/twitter/twitteroauth.php");  require 'config.php';   if(isset($_GET['action']) && $_GET['action'] =='del'){       $RC80D50582FD27388FD0041E4AB7EC6E8 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->real_escape_string(strip_tags($_GET['id']));              $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("DELETE FROM replies WHERE `id`=".$_GET['id']);       $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-success'> تم الحذف </span></center>       <meta http-equiv='refresh' content='1,URL=auto-reply.php'>";          }    if(isset($_POST['action'])){      if(isset($_POST['uid']) && !empty($_POST['uid'])){       $R050F40040BA8F31097940F999AAC6639 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->real_escape_string(strip_tags($_POST['tweet']));       $R517C8C6C47B742944A030A8DE3977256 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->real_escape_string(strip_tags($_POST['screen_name']));                             $RC523FCD5B14FA22CF0751AB0543C1FE9 = $_POST['uid'];       $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("INSERT INTO replies (`tweet`,`screen_name`,`user_id`) VALUES       ('$R050F40040BA8F31097940F999AAC6639','$R517C8C6C47B742944A030A8DE3977256',$RC523FCD5B14FA22CF0751AB0543C1FE9);");              $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-success'> تم إضافة الحساب  </span></center>       <meta http-equiv='refresh' content='1'>";      }   } else {       }  ?>
<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
   <ul class="breadcrumb">
        <li class="active"><b>الرد التلقائي </b></li>
      </ul>
 <div class="alert alert-info"><b>(اجعل حساباتك ترد على هذا الحساب تلقائياً)</b></div>
<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
  
    <div class="form-group">
	<label>حدد حساب من المشاهير : </label>
		<div class="input-group">
			<input type="text" name="screen_name" class="form-control" placeholder="Username" style="text-align:left;" dir="ltr">
			<span class="input-group-addon">@</span>
		</div>
    </div>
	<br/>
	<label>حدد تغريدة الرد  :</label><textarea rows="3" class="input-xxlarge " id="tw"  name="tweet" placeholder="غرد هنا" ></textarea>
	<br/><br/>
	<div class="alert alert-info"> (اختر حساباتك التي ترد على الحساب)</div>
	<h4>اختر من حساباتك  </h4>
<table class="table table-bordered">
    <thead>
    <tr> 	<th>ID </th>
			<th> الاسم </th>
			<th> اسم تويتر </th>
    </tr>
    </thead>
    <tbody>
<?php   if ($R679E9B9234E2062F809DBD3325D37FB6 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT  *  FROM `users`")) {          while ($R4EEB713E57BBAAF1217CF39632604473 = $R679E9B9234E2062F809DBD3325D37FB6->fetch_assoc()) {        echo '<tr><td><input type="radio" name="uid" value="'.$R4EEB713E57BBAAF1217CF39632604473['id'].'"/></td>   <td>'.$R4EEB713E57BBAAF1217CF39632604473['username'].'</td>   <td><a href="https://twitter.com/'.$R4EEB713E57BBAAF1217CF39632604473['screen_name'].'">'.$R4EEB713E57BBAAF1217CF39632604473['screen_name'].'</a></td>   </tr>';     }           $R679E9B9234E2062F809DBD3325D37FB6->free(); }  ?>
    </tbody>
    </table>
	<br/>
	<input type="hidden" name="action" value="retweet" />
    <button  type="submit" class="btn btn-default">أضف إلى القائمة </button>
  
 </form>
</div>

<hr/>
<span id='msg'><?php echo (isset($RDD95BBEC198B2C577F5B3E60A5984492))? $RDD95BBEC198B2C577F5B3E60A5984492 :''; ?></span> 
<h4>قائمة حسابات الرد على المشاهير </h4>
   <table class="table table-bordered">
    <thead>
    <tr>
	<th>اسم تويتر</th>
	<th> التغريده </th>
	<th> </th>
    </tr>
    </thead>
    <tbody>
<?php   if($R0DBCFDF452A9D42FDE00B25C4F9F1161 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM replies")){     $RB7A065599F06CCEB93D749568A5E1C54 = $R0DBCFDF452A9D42FDE00B25C4F9F1161->num_rows;     if($RB7A065599F06CCEB93D749568A5E1C54 > 0){     while($R4EEB713E57BBAAF1217CF39632604473 = $R0DBCFDF452A9D42FDE00B25C4F9F1161->fetch_assoc()){      echo "<tr><td><a href='https://twitter.com/".$R4EEB713E57BBAAF1217CF39632604473['screen_name']."'>".      $R4EEB713E57BBAAF1217CF39632604473['screen_name']."@</a></td><td width='65%'>".$R4EEB713E57BBAAF1217CF39632604473['tweet']."</td>";      echo "<td><a class='btn btn-danger' href='?action=del&id=".$R4EEB713E57BBAAF1217CF39632604473['id']."'> حذف </a> </td></tr>";      }     }    } $R0DADB0D8CA9669A3F9F73A406CB0A0FC->close(); ?>
</table>
</div> 
</div>
</div>
<?php  } else {  session_destroy();  header("Location: index.php"); }  ?>