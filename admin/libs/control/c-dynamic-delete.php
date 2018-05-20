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

		$lang="SELECT*FROM dynamic WHERE id='$id'";
		$query=mysql_query($lang,$conn);

		if($res=mysql_fetch_array($query))
		{
			$img=$res["img"];
			$uid=$res["uid"];
		}

		$imgfile = "../../../source/img/".$uid."/".$img;

		if(is_file($imgfile)) 
		{	
			/*
			// unlink() 函数删除文件。
			// 若成功，则返回 true，失败则返回 false。
			*/
			if (!unlink($imgfile))
			{
				$arr["file"]=400;
			}
			else
			{
				$arr["file"]=200;
			}
		}		
		else
		{
			$arr["file"]=404;
		}

		$land="DELETE FROM dynamic WHERE id='$id'";
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