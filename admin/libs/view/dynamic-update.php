<?php 
  @session_start();
  $S_USRENAME = $_SESSION['S_USRENAME'];
  $S_UID =  $_SESSION['S_UID'];
  require_once("../../../config.php");
?>
<html>
<head>
	<meta charset="utf-8">
	<title>修改动态</title>
</head>
<link rel="stylesheet" type="text/css" href="../../src/AmazeUI-2.7.2/assets/css/amazeui.css">
<link rel="stylesheet" type="text/css" href="../../src/AmazeUI-2.7.2/assets/css/admin.css">
<link rel="stylesheet" type="text/css" href="../../src/css/ls.css">
<body>
<div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf">
          <strong class="am-text-primary am-text-lg">
            阑山动态
          </strong>
          /
          <small>
          修改动态
          </small>
        </div>
      </div>
      <?php   
        $id = $_GET["id"];
        $land= "SELECT * FROM dynamic WHERE id='$id'";
        $query=mysql_query($land,$conn);

        if($res = mysql_fetch_array($query)){
          $title = $res["title"];
          $id = $res["id"];

          $uid = $res["uid"];

          $des = $res["des"];
          $content = $res["content"];
          $img = $res["img"];
          $dTime = $res["dTime"];

        }
      ?>
      <div class="am-g">
        <form class="am-form"  action="../control/c-dynamic-update.php" method="post" enctype="multipart/form-data" >
          <fieldset>
          
            <div class="am-form-group">
              <label for="doc-ipt-title">标题</label>
              <input type="text" name="title" class="" id="doc-ipt-title" placeholder="输入标题" value="<?php echo $title; ?>">
            </div>

            <div class="am-form-group">
              <label for="doc-ipt-des">描述</label>
              <input type="text" name="des" class="" id="doc-ipt-des" placeholder="输入描述" value="<?php echo $des; ?>">
            </div>

            <div class="am-form-group">
              <label for="doc-ipt-file">图片</label>
              <input type="file" name="img" id="doc-ipt-file">
              <p class="am-form-help">请选择要上传的文件...</p>
                <?php 
                  $imgSrc="../../../source/img/".$uid."/".$img;
                ?>
                <div style="max-width: 100px;">
                  <img src="<?php echo $imgSrc;?>" width="100%">
                </div>
                <input type="hidden" name="oldimg" value="<?php echo $img;?>">
                <input type="hidden" name="uid" value="<?php echo $uid;?>">
                <input type="hidden" name="id" value="<?php echo $id;?>">


              
            </div>


            <div class="am-form-group">
              <label for="doc-int-content">内容</label>
              <textarea class="" name="content" rows="5" id="doc-int-content"><?php echo $content; ?></textarea>
            </div>

            <p><button type="submit" class="am-btn am-btn-primary">提交</button></p>
          </fieldset>
        </form>
      </div>
    </div>
</body>
<script type="text/javascript" src="../../src/js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="../../src/js/vue.js"></script>
<!--<![endif]-->
<script type="text/javascript"  src="../../src/AmazeUI-2.7.2/assets/js/amazeui.js"></script>
<!-- kindeditor -->
<script type="text/javascript" charset="utf-8" src="../kindeditor/kindeditor-all.js"></script>
<script type="text/javascript" charset="utf-8" src="../kindeditor/lang/zh-CN.js"></script>
<script type="text/javascript" charset="utf-8" src="../kindeditor/plugins/code/prettify.js"></script>
<script type="text/javascript">
  KindEditor.ready(function(K){
    var editor1=K.create('textarea[name="content"]',{
      cssPath:"../kindeditor/plugins/code/prettify.css",
      uploadJson:"../kindeditor/php/upload_json.php",
      fileManagerJson:"../kindeditor/php/file_manager_json.php",
      allowFileManager:true,
      afterCreate:function(){
        var self=this;
        K.ctrl(document,13,function(){
          self.sync();
          K("form[name=myform]")[0].submit();
        });
      }
    });
    prettyPrint();
  })
</script>
</html>