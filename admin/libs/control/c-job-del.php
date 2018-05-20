<?php
	@session_start();
   	require_once("../../../config.php");
   	date_default_timezone_set('PRC');
   	
	$id=intval($_POST["id"]);
	// echo "-----";

	// echo $id."<br>";
	// echo "------";
	if(!empty($id))
	{
		$arr=array();
		$arr["rstId"]=0;

		$land="DELETE FROM job WHERE id='$id'";
		$queryDelete=mysql_query($land,$conn);

		
		if($queryDelete)
		{
			$arr["code"]=200;
			$arr["msg"]="删除成功";
			$arr["rstId"]=1;
		}
		else
		{
			$arr["code"]=404;	
			$arr["msg"]="删除失败";
		}
		
		$JSON=json_encode($arr);
		print_r($JSON);

	}
?>