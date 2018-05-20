<?php 
  @session_start();
  $S_USRENAME = $_SESSION['S_USRENAME'];
  $S_UID =  $_SESSION['S_UID'];
  require_once("../../../config.php");
?>
<html>
<head>
  <meta charset="utf-8">
  <title>应聘详情</title>
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
            阑山应聘
          </strong>
          /
          <small>
          应聘详情
          </small>
        </div>
      </div>
      <?php   
        $id = $_GET["id"];
        $land= "SELECT * FROM job WHERE id='$id'";
        $query=mysql_query($land,$conn);

        if($res = mysql_fetch_array($query)){
          $id = $res["id"];
          $position = $res["position"];

          $username = $res["username"];

          $tel = $res["tel"];
          $email = $res["email"];
          $content = $res["content"];
          $uid = $res["uid"];

          $dTime = $res["dTime"];

        }
      ?>
      <div class="am-g">
        <form class="am-form" >
          <fieldset>
          
            <div class="am-form-group">
              <label for="doc-ipt-position">应聘岗位</label>
              <input type="text" name="position" class="" id="doc-ipt-position" placeholder="应聘岗位" value="<?php echo $position; ?>">
            </div>

            <div class="am-form-group">
              <label for="doc-ipt-username">你的名字</label>
              <input type="text" name="username" class="" id="doc-ipt-username" placeholder="输入名字" value="<?php echo $username; ?>">
            </div>


            <div class="am-form-group">
              <label for="doc-ipt-tel">电话号码</label>
              <input type="text" name="tel" class="" id="doc-ipt-tel" placeholder="输入电话号码" value="<?php echo $tel; ?>">
            </div>

            <div class="am-form-group">
              <label for="doc-ipt-email">电子邮件</label>
              <input type="text" name="email" class="" id="doc-ipt-email" placeholder="输入描述" value="<?php echo $email; ?>">
            </div>

            <div class="am-form-group">
              <label for="doc-ipt-dTime">应聘时间</label>
              <input type="text" name="dTime" class="" id="doc-ipt-dTime" placeholder="输入应聘时间" value="<?php echo $dTime; ?>">
            </div>

            <div class="am-form-group">
              <label for="doc-int-content">其他内容</label>
              <textarea class="" name="content" rows="5" id="doc-int-content"><?php echo $content; ?></textarea>
            </div>

         <!--    <p><button type="submit" class="am-btn am-btn-primary">提交</button></p> -->
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