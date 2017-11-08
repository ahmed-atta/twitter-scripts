 <?php if(@$_SESSION['retweet_admin'] === 1): ?>
 <div class="span3">
    <ul class="nav nav-list bs-docs-sidenav">
        <li><a href="index.php"><i class="icon-chevron-right"></i><i class="icon-home"></i> الرئيسيه</a></li>
        <li><a href="accounts.php"><i class="icon-chevron-right"></i><i class="icon-user"></i>   حسابات المشتركين </a></li>
        <li><a href="tweet.php"><i class="icon-chevron-right"></i><i class="icon-pencil"></i>   جدولة التغريدات  </a></li>
		<li><a href="mytweets.php"><i class="icon-chevron-right"></i><i class="icon-pencil"></i>  التغريدات المجدولة </a></li>		  
		<li><a href="retweet.php"><i class="icon-chevron-right"></i><i class="icon-refresh"></i> الريتويت / المفضلة </a></li>
        <li><a href="auto-retweet.php"><i class="icon-chevron-right"></i><i class="icon-retweet"></i> الريتويت/المفضلة التلقائي</a></li>
        <li><a href="followers.php"><i class="icon-chevron-right"></i><i class="icon-list"></i> متابعة حساب </a></li>
		<li><a href="auto-reply.php"><i class="icon-chevron-right"></i><i class="icon-list"></i> الرد التلقائي </a></li>
		<li><a href="spam.php"><i class="icon-chevron-right"></i><i class="icon-list"></i> إرسال سبام  </a></li>
		<li><a href="messages.php"><i class="icon-chevron-right"></i><i class="icon-list"></i> الرسائل الخاصة</a></li>
    </ul>
   </div>   
 <?php endif; ?>