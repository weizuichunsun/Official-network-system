<?php
	@session_start();
  	require_once("../../../config.php");
   	date_default_timezone_set('PRC');

 // position:position.value,
 //                  username:username.value,
 //                  tel:tel.value,
 //                  email:email.value,
 //            	  content:content.value

   	$position=$_POST["position"];   
	$username=$_POST["username"];
	$tel=$_POST["tel"];

	$email=$_POST["email"];
	$content=$_POST["content"];


	$dTime=date("Y-m-d h:i:s");


	
	// $lang = "INSERT INTO dynamic(title,des,img,content,dTime) VALUES('$title','$des','$img','$content','$dTime')";
	
	$lang = "INSERT INTO job(position,username,tel,email,content,dTime) VALUES('$position','$username','$tel','$email','$content','$dTime')";


	$result = mysql_query($lang, $conn) or die("error".mysql_error());
	$insertId=mysql_insert_id($conn);

	$arr=array();
		$arr["rstId"] =0;

	if(($result)&&!empty($insertId)){

		$arr["rstId"] =1;
		$arr["insertId"] =$insertId;
		$arr["status"] =200;
		$arr["msg"] ="添加成功";



		
	}
	else
	{
		$arr["status"] =400;
		$arr["msg"] ="添加失败";


	}

 	$JSON=json_encode($arr);
    print_r($JSON); 

	mysql_close($conn);
?>