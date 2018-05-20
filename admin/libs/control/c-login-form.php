<?php
	
	@session_start();
	require_once("../../../config.php");
	date_default_timezone_set('PRC');

	$username=$_GET["username"];
	$password=$_GET["password"];

	$arr=array();
	$land="SELECT * FROM user WHERE username='$username' AND password='$password'";
	$query=mysql_query($land,$conn);
	if($query){
		
		$res=mysql_fetch_array($query);
		if($res){

			$_SESSION["S_USRENAME"]=$res["username"];
			$_SESSION["S_UID"]=$res["uid"];

			$arr["status"]=200;
			$arr["msg"]="登陆成功";

			// $arr["S_USRENAME"]=$_SESSION["S_USRENAME"];
			// $arr["S_UID"]=$_SESSION["S_UID"];
			

		}
		else{
			$arr["status"]=404;
			$arr["msg"]="账号或密码错误";


			unset($_SESSION['S_USRENAME']);
			unset($_SESSION['S_UID']);

		}
	}
	else{
		$arr["status"]=400;
		$arr["msg"]="请求失败";

		unset($_SESSION['S_USRENAME']);
		unset($_SESSION['S_UID']);
	}
	$JSON=json_encode($arr);
	print_r($JSON); 

?>
<?php
	mysql_close($conn);
?>