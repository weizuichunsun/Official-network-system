<?php 
	@session_start();
	$COOKIE_S_USRENAME = $_SESSION['S_USRENAME'];
	$COOKIE_S_UID =  $_SESSION['S_UID'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>澜山网站建设</title>
</head>
<link rel="stylesheet" type="text/css" href="./src/AmazeUI-2.7.2/assets/css/amazeui.css">
<link rel="stylesheet" type="text/css" href="./src/AmazeUI-2.7.2/assets/css/admin.css">
<link rel="stylesheet" type="text/css" href="./src/css/ls.css">
<body>
<?php
  require_once("./libs/view/admin-header.php");
?>
<div class="am-cf admin-main">
  <?php
    require_once("./libs/view/admin-slide.php");
  ?>
  <!-- content start -->
  <div class="admin-content">
    <iframe src="./libs/view/dynamic-list.php" width="100%" height="100%" frameborder="0" name="main"></iframe>
  </div>
    <!-- content end -->
  </div>
  <a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu"
  data-am-offcanvas="{target: '#admin-offcanvas'}">
  </a>
</body>
<script type="text/javascript" src="./src/js/util.js"></script>
<script type="text/javascript" src="./src/js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="./src/js/vue.js"></script>
<!--<![endif]-->
<script type="text/javascript"  src="./src/AmazeUI-2.7.2/assets/js/amazeui.js"></script>
<?php 
	if(!$COOKIE_S_USRENAME&&!$COOKIE_S_UID){
?>
  <script type="text/javascript">
    ModalLoading({
      title:"检测到你未登陆，正在退出",
      show:true
    });
    setTimeout(() => {
      window.location.href="./login.php";
    }, 2000);
	</script>	
<?php
  }
?>
</html>