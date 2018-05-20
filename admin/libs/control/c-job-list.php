<?php
    @session_start();
    require_once("../../../config.php");
    date_default_timezone_set('PRC');

    $uid=$_GET["uid"];

    $page=$_GET["page"];
    $pageSize=$_GET["pageSize"];
  
    $arr = array();
    $arr["rstId"]=0;

    // if(!$page||!$pageSize){
    //     $page=1;
    //     $pageSize=15;
    // }

    $dTime=date("Y-m-d h:i:s");
    
    $pageStart = ($page - 1) * $pageSize;


    if($uid){
        $land= "SELECT *FROM job  LIMIT $pageStart,$pageSize";
        $lanc="SELECT COUNT(*) FROM job";

        $queryLand = mysql_query($land,$conn);

        $queryLanc = mysql_query($lanc,$conn);

        
        if($queryLand&&$queryLanc){
            $arr["code"]=200;   //200 代表有数据输出
            $arr["rstId"]=1;   //200 代表有数据输出
            
            $arr["msg"] ="请求成功";

            if($resLanc = mysql_fetch_row($queryLanc)){
                $arr["count"] =  $resLanc[0];
            }
            $i=0;

            while($resLand=mysql_fetch_array($queryLand)){

                $arr["data"][$i]["id"]=$resLand["id"];

                $arr["data"][$i]["uid"] = $resLand["uid"];
                $arr["data"][$i]["position"] = $resLand["position"];
                $arr["data"][$i]["username"] = $resLand["username"];
                $arr["data"][$i]["tel"] = $resLand["tel"];
                $arr["data"][$i]["email"] = $resLand["email"];
                $arr["data"][$i]["content"] = $resLand["content"];
                $arr["data"][$i]["dTime"] = $resLand["dTime"];

                $i++; 
            }

        }
        else
        {
            $arr["code"]=400;   //400 参数错误
            $arr["msg"] ="参数错误";
        }
    }
    else{
        $arr["code"]=400;   //400 参数错误
        $arr["msg"] ="检查是否登陆";    
    }

    $JSON=json_encode($arr);
    print_r($JSON); 
    
?>
<?php
	mysql_close($conn);
?>