<?php
	@session_start();
	
	$S_USRENAME=$_SESSION["S_USRENAME"];
	$S_UID=$_SESSION["S_UID"];


	if(isset($_SESSION["S_USRENAME"])||isset($_SESSION["S_UID"]))
	{
		unset($_SESSION['S_USRENAME']);
		unset($_SESSION['S_UID']);
	} 
	
?>   
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<link rel="stylesheet" type="text/css" href="../../src/AmazeUI-2.7.2/assets/css/amazeui.css">
<link rel="stylesheet" type="text/css" href="../../src/AmazeUI-2.7.2/assets/css/admin.css">
<link rel="stylesheet" type="text/css" href="../../src/css/ls.css">
<body>

</body>
<script type="text/javascript" src="../../src/js/util.js"></script>
<script type="text/javascript" src="../../src/js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="../../src/js/vue.js"></script>
<!--<![endif]-->
<script type="text/javascript"  src="../../src/AmazeUI-2.7.2/assets/js/amazeui.js"></script>
<script type="text/javascript">
	function ModalLoading(obj){
	    var title=obj.title||"";
	    var templete=`<div class="am-modal am-modal-loading" id="my-modal-loading">
	        <div class="am-modal-dialog">
	        <div class="am-modal-hd">${title}</div>
	        <div class="am-modal-bd">
	            <span class="am-icon-spinner am-icon-spin"></span>
	        </div>
	        </div>
	    </div>`;
	  
	    try{
	        obj.show=obj.show||true;
	        if(obj.show){
	            $("body").append(templete);
	        }
	        else{
	            $("body").remove("#my-modal-loading");
	        }

	        $("#my-modal-loading").show();
	        $("#my-modal-loading").css("opacity","1"); //设置透明度
	    }
	    catch(e){
	        console.log("ModalLoading e=>",e);
	    }
	}
	ModalLoading({
		show:true,
		title:"正在退出系统..."
	})
	setTimeout(() => {
		window.location.href="../../login.php";
	}, 1000);
    
</script> 
</html>
