<?php
/** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  info@parmagy.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/
 if($_SESSION['hashtag_admin'] === 1): ?>
 <div class="span3">
    <ul class="nav nav-list bs-docs-sidenav">
        <li><a href="index.php"><i class="icon-chevron-right"></i><i class="icon-home"></i> الرئيسيه</a></li>
        <li><a href="accounts.php"><i class="icon-chevron-right"></i><i class="icon-user"></i>   حساباتي</a></li>
        <li><a href="tweet.php"><i class="icon-chevron-right"></i><i class="icon-pencil"></i>   تغريد بالهاشتاجات</a></li>
		<li><a href="mytweets.php"><i class="icon-chevron-right"></i><i class="icon-pencil"></i>  التغريدات المحفوظه</a></li>		  
    </ul>
	
	<br/>
	<br/>
	 <img src='images/bird.png' style="margin:-10px 50px"/>
	<a href="index.php?go=logout" class="btn btn-danger btn-block"><i class="icon-off "></i> تسجيل الخروج </a>
   </div>   
 <?php endif; ?>