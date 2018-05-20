<?php
	@session_start();
  	require_once("../../../config.php");
   	date_default_timezone_set('PRC');

	$id=$_POST["id"];
	$title=$_POST["title"];
	$content=$_POST["content"];
	$des=$_POST["des"];

	$uid=$_POST["uid"];

	$dTime=date("Y-m-d h:i:s");
	$oldimg=$_POST["oldimg"];


	$img=$_FILES["img"];

	// print_r($id);
	// print_r($title);
	// print_r($content);
	// print_r($des);
	// print_r($dTime);
	// print_r($img);
	// print_r($img);


	// return false;
	/********图片start*******/
	function imgUpload($name,$type,$tmp_name,$error,$size,$uid){
		//2、判断下错误号，只有为0或者是UPLOAD_ERR_OK，没有错误发生，上传成功
		$maxSize=2097152; //允许的最大值
		$allowExt=array("jpeg","jpg","png","gif");

		$flag=true; //检测是否为真实的图片类型
		// echo $name,$type,$tmp_name,$error,$size;
		if($error==UPLOAD_ERR_OK){
			// 上传文件大小
			if($img_file_size>$maxSize){
				exit("上传文件大小过大");
			}
			$ext=strtolower(end(explode(".", $name)));
			$ext=pathinfo($name,PATHINFO_EXTENSION);

			// echo $ext;
			if(!in_array($ext, $allowExt)){
				exit("非法文件类型");
			}

			//判断文件是否是通过HTTP POSTf方式上传来的
			if(!is_uploaded_file($tmp_name)){
				exit("文件不是通过HTTP POST方式传输来的");
			}

			if($flag){
				if(!getimagesize($tmp_name)){
					exit("不是真实的图片类型");
				}
			}

			$path="../../../source/img/".$uid."/";
			if(!file_exists($path)){
				mkdir($path,0777,true);
				chmod($path, 0777);
			}
			//确保文件名唯一，防止重名产生覆盖

			//确保文件名唯一，防止重名产生覆盖
			// $imgName=md5(uniqid(microtime(true),true)).".".$ext;
			$imgName =date("Ymd")."_".date("His") . '_'. rand(100, 999) . '.' . $ext;
			$destination=$path."/".$imgName;

			if(!move_uploaded_file($tmp_name, $destination)){
				echo "文件".$name."上传失败";
			}
			else{
				echo "文件".$name."上传成功";
			}

		
			return $imgName;
		}else{
			switch ($error) {
				case 1:
					echo '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
					break;
				case 2:
					echo '超过了表单MAX_FILE_SIZE限制的大小';
					break;
				case 3:
					echo '文件部分被上传';
					break;
				case 4:
					echo '没有选择上传文件(新闻小图)';
					break;
				case 6:
					echo '没有找到临时目录';
					break;
				case 7:
				case 8:
					echo '系统错误';
					break;
			}
		}
	}
	/********图片end*******/

	// 图片文件流
	// Array ( [name] => g.gif [type] => image/gif [tmp_name] => C:\Windows\Temp\php6B77.tmp [error] => 0 [size] => 17046 ) 
	
	$img=$img["name"];
	if($img!="")
	{
		$img_file_type=$img["type"];
		$img_file_tmp_name=$img["tmp_name"];
		$img_file_error=$img["error"];
		$img_file_size=$img["size"];
		$imgName=imgUpload($img,$img_file_type,$img_file_tmp_name,$img_file_error,$img_file_size,$uid,$oldimg);

		$file_del_path = "../../../source/img/".$uid."/".$oldimg;  //删除不要的图片
		if(is_file($file_del_path)){
			if (@!unlink($file_del_path))
			{
			  echo ("Error deleting $file");
			}
			else
			{
			  echo ("Deleted $file success");
			}
		}
	
		// echo "999999999999";

		$sql_update = "UPDATE dynamic SET title='$title',img='$imgName',des='$des',dTime='$dTime',content='$content' WHERE id='$id'";
	}
	else
	{

		if(!$des){
			$des=" ";
		}

		$sql_update = "UPDATE dynamic SET title='$title',dTime='$dTime',content='$content',des='$des' WHERE id='$id'";
	
		// echo $sql_update;
	}

// return false;
	$result_update = mysql_query($sql_update, $conn);
	if($result_update)
	{
?>					
<script type="text/javascript">
		alert("修改成功");
		window.location.href="../view/dynamic-list.php";
	</script>
<?php				
	}
	else
	{
		die("error".mysql_error());
	}
?>					
<?php
	mysql_close($conn);
?>