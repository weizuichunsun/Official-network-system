<?php
	@session_start();
  	require_once("../../../config.php");
   	date_default_timezone_set('PRC');



   	$title=$_POST["title"];   
	$des=$_POST["des"];
	$content=$_POST["content"];
	$uid =  $_SESSION['S_UID'];
	if(!$uid){
		$uid="201805";
	}

	$dTime=date("Y-m-d h:i:s");

	/**图片 start***/
	function imgUpload($name,$type,$tmp_name,$error,$size,$uid){
		
		$maxSize=(1024*1024)*2; //允许的最大值  //2M
		$allowExt=array("jpeg","jpg","png","gif"); 
		$flag=true; //检测是否为真实的图片类型

		if($error==UPLOAD_ERR_OK){
			// 上传文件大小
			if($size>$maxSize){
				exit("上传文件大小过大,不能超过2M");
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

			$path="../../../source/img/".$uid;
		
			if(!file_exists($path)){
				mkdir($path,0777,true);
				chmod($path, 0777);
			}
			//确保文件名唯一，防止重名产生覆盖
			$img_name =date("Ymd")."_".date("His") . '_'. rand(1000, 9999) . '.' . $ext;
			$destination=$path."/".$img_name;

			echo $destination."<br>";
			
			if(!move_uploaded_file($tmp_name, $destination)){
				echo "文件".$name."上传失败";
			}
			else{
				echo "文件".$name."上传成功";
			}

			return $img_name;
		}
		else
		{
			
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


	$img=$_FILES["img"];
	$img_file_name=$img["name"];
	$img_file_type=$img["type"];
	$img_file_tmp_name=$img["tmp_name"];
	$img_file_error=$img["error"];
	$img_file_size=$img["size"];
	$img_name=imgUpload($img_file_name,$img_file_type,$img_file_tmp_name,$img_file_error,$img_file_size,$uid);
	/** 图片 end***/

	// $lang = "INSERT INTO dynamic(title,des,img,content,dTime) VALUES('$title','$des','$img','$content','$dTime')";
	
	$lang = "INSERT INTO dynamic(img,title,des,uid,dTime,content) VALUES('$img_name','$title','$des','$uid','$dTime','$content')";

	$result = mysql_query($lang, $conn) or die("error".mysql_error());
	$insertId=mysql_insert_id($conn);

	if(($result)&&!empty($insertId)){
		echo "添加成功".$insertId."<br>";
?>
		<script type="text/javascript">
			window.location.href="../view/dynamic-list.php";
		</script>
<?php
	}
?>
<?php
	mysql_close($conn);
?>