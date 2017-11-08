<?php
/** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  info@parmagy.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/
 session_start(); if(isset($_SESSION['hashtag_admin']) && $_SESSION['hashtag_admin'] == 1) {  require_once('config.php');  if(isset($_POST['action']) && $_POST['action'] == 'add'){   require_once('lib/twitter/twitteroauth.php');   switch($_POST['tweet_type']){    case 'now':    {     $R3247F9DE3A59E8FE17114A24F81329D3 = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, TOKEN_SECRET);     if(isset($_POST['all']) && $_POST['all'] == 'YES'){      $RA123E8B30C415D1471A6C71BE5AA1713 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM users ");     } else if(isset($_POST['uids']) && !empty($_POST['uids'])){      $R70A50ADAD9E19BF7852ADE4589431B84 = implode(",", $_POST['uids']);      $RA123E8B30C415D1471A6C71BE5AA1713 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM users WHERE  id IN (".$R70A50ADAD9E19BF7852ADE4589431B84.");");     } else {       echo " اختر حساباتك !!!";       exit;     }          $R8CE5CE11AD9037C5520515DEF277FD9D = strip_tags($_POST['txtwi']);     if($R8CE5CE11AD9037C5520515DEF277FD9D){       switch($_POST['hashtag_location']){        case 'sa':          $R0FC694E85343C291F53770941ABC26F0 = "23424938";         break;        case 'eg':         $R0FC694E85343C291F53770941ABC26F0 = "23424802";         break;        case 'kw':         $R0FC694E85343C291F53770941ABC26F0 = "23424870";          break;        case 'ae':         $R0FC694E85343C291F53770941ABC26F0 = "23424738";          break;        case 'qa':         $R0FC694E85343C291F53770941ABC26F0 = "23424930";          break;        case 'bh':         $R0FC694E85343C291F53770941ABC26F0 = "23424753";          break;        default:       }       $R6F2F8CF05B0EF041F6F1C7FD327D4627 = $R3247F9DE3A59E8FE17114A24F81329D3->get('trends/place',array("id"=> $R0FC694E85343C291F53770941ABC26F0));       $R89370CFFF4BBFFC8B263128EC6914311  ="\n";      }      $R5FF20CD486D4D3866232FF9C190C883D = mb_strlen($R8CE5CE11AD9037C5520515DEF277FD9D, 'UTF-8');      $RF97F567927F6AF780E206D642A40A602 = 140 - $R5FF20CD486D4D3866232FF9C190C883D;        for($RA16D2280393CE6A2A5428A4A8D09E354 = 0; $RA16D2280393CE6A2A5428A4A8D09E354 < 10; $RA16D2280393CE6A2A5428A4A8D09E354++){       $R8EEB1221AED257518AC7928EB7CF9AA3 = $R89370CFFF4BBFFC8B263128EC6914311 .' '.$R6F2F8CF05B0EF041F6F1C7FD327D4627[0]->trends[$RA16D2280393CE6A2A5428A4A8D09E354]->name;        if(mb_strlen($R8EEB1221AED257518AC7928EB7CF9AA3, 'UTF-8') < $RF97F567927F6AF780E206D642A40A602)         $R89370CFFF4BBFFC8B263128EC6914311 .=' '.$R6F2F8CF05B0EF041F6F1C7FD327D4627[0]->trends[$RA16D2280393CE6A2A5428A4A8D09E354]->name;        else          break;       }      $R8CE5CE11AD9037C5520515DEF277FD9D .= $R89370CFFF4BBFFC8B263128EC6914311;      while($RE484ED591E12CF9125AE1D47AE08748B = $RA123E8B30C415D1471A6C71BE5AA1713->fetch_assoc()) {       $R185F7CD086AFAD484A334CB45591BFAB = $RE484ED591E12CF9125AE1D47AE08748B['accessToken'];       $R74056FB4CE1465F0BFBFEA38652641B4 = $RE484ED591E12CF9125AE1D47AE08748B['accessTokenSecret'];       $R3247F9DE3A59E8FE17114A24F81329D3 = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $R185F7CD086AFAD484A334CB45591BFAB, $R74056FB4CE1465F0BFBFEA38652641B4);       $R8C072FDF530C84D973287CC76B48DE1A = $R3247F9DE3A59E8FE17114A24F81329D3->post('statuses/update',array('status' =>$R8CE5CE11AD9037C5520515DEF277FD9D));      }                  $RDD95BBEC198B2C577F5B3E60A5984492 = "<script> $(document).ready(function(){          $('#alert').show().animate({opacity: 1.0}, 3000).fadeOut(500);        });       </script>       <div class='alert alert-success' id='alert' >تم الإنتهاء من التغريد</div>";          } break;    case 'save':    {     if(isset($_POST['all']) && $_POST['all'] == 'YES'){      $RC523FCD5B14FA22CF0751AB0543C1FE9 = -1;      } else if(isset($_POST['uids']) && !empty($_POST['uids'])){      $R70A50ADAD9E19BF7852ADE4589431B84 = implode(",", $_POST['uids']);      $RC523FCD5B14FA22CF0751AB0543C1FE9 = $R70A50ADAD9E19BF7852ADE4589431B84;         } else {      echo " اختر حساباتك !!!";      exit;     }      @$R52836516BD09A53E33DE486CF68EDB96 = strip_tags($_POST['txtwi']);       $RB636342044BD1472AB25023064EF401A = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->real_escape_string($_POST['hashtag_location']);       $RBB32441668F470FBCC1C73DDEEF24A3A = "INSERT INTO `tweets`(`id`, `tweet`, `user_id`, `count`,`hashtag_location`)          VALUES (NULL,'$R52836516BD09A53E33DE486CF68EDB96',$RC523FCD5B14FA22CF0751AB0543C1FE9 ,0 ,'$RB636342044BD1472AB25023064EF401A');";            $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query($RBB32441668F470FBCC1C73DDEEF24A3A);       $RDD95BBEC198B2C577F5B3E60A5984492 = "<br/><center><span class='label label-success'>تم </span></center>            <meta http-equiv='refresh' content='2; url=tweet.php'>";            } break;    default:          }   }  ?>
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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<div class="container-fluid">
 <div class="row-fluid">
       
	<?php include_once("sidebar.php"); ?>
<!-- ============ End Sidebar =================== -->
<div class="span9 TESTTTT">
<ul class="breadcrumb">
        <li class="active"><b>تغريد بالهاشتاجات</b></li>
      </ul>
   <div class="alert alert-info"> غرد لكل حساباتك</div>
<div>
 
 <?php echo(isset($RDD95BBEC198B2C577F5B3E60A5984492))? $RDD95BBEC198B2C577F5B3E60A5984492 :''; ?>
<div style="margin-top: 0px;margin-right: 0px;">
 <form style="margin-top: 10px;margin-right: 30px;"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal">
    <div class="form-group">
	    <label>غرد :</label>
		<textarea rows="3"  style="width: 60%;" id="tw" name="txtwi" placeholder="غرد هنا" ></textarea></td>
    </div>
		<br/>
		<table>
		
			<tr><td colspan='3'><h5> النشر بالهاشتاجات النشطه : </h5></td></tr>
			<tr>
				<td>	<select  name="hashtag_location" >
				    <option value='sa'>المملكة العربية السعوديه</option>
					<option value='ae'>الإمارات العربيه المتحدة</option>
					<option value='bh'>البحرين</option>
					<option value='kw'>الكويت </option>
					<option value='qa'> قطر </option>
					<option value='eg'>جمهورية مصر العربية</option>
			        </select></td>
			</tr>
			
			</table>
				<br/>
			
		<select class="span3" name='tweet_type'>
			<option value='save' selected>حفظ </option>
			<option value='now'>تغريد فوري الآن</option>
		</select>
		<hr/>
		<!--   ================ -->
		<div class="checkbox">
				<input type="checkbox" name="all" value="YES"/><label>&nbsp;&nbsp;  كل الحسابات  </label> </div>
		<h3>اختر من حساباتك  </h3>
<table class="table table-bordered">
    <thead>
    <tr> 	<th>ID </th>
			<th> الاسم </th>
			<th> اسم تويتر </th>
    </tr>
    </thead>
    <tbody>
<?php   if ($R679E9B9234E2062F809DBD3325D37FB6 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT  *  FROM `users` ")) {          while ($R4EEB713E57BBAAF1217CF39632604473 = $R679E9B9234E2062F809DBD3325D37FB6->fetch_assoc()) {        echo '<tr><td><input type="checkbox" name="uids[]" value="'.$R4EEB713E57BBAAF1217CF39632604473['id'].'"/></td>   <td>'.$R4EEB713E57BBAAF1217CF39632604473['username'].'</td>   <td><a href="https://twitter.com/'.$R4EEB713E57BBAAF1217CF39632604473['screen_name'].'">'.$R4EEB713E57BBAAF1217CF39632604473['screen_name'].'</a></td>   </tr>';     }           $R679E9B9234E2062F809DBD3325D37FB6->free(); }  $R0DADB0D8CA9669A3F9F73A406CB0A0FC->close(); ?>
    </tbody>
    </table>
		
		
		<!-- ================== -->
    <div class="form-group">
	<input type="hidden" name="action" value="add" />
    <button  type="submit" class="btn btn-large btn-success"> حفظ التغريدة</button>
    </div>
	
 </form>

</div>
 

 </div>
<div id="msg"></div>
</div>
</div>
<?php } else      {  echo "<meta http-equiv='refresh' content='0;URL=index.php'>"; }   ?>