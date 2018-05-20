<?php 
	@session_start();
	$S_USRENAME = $_SESSION['S_USRENAME'];
	$S_UID =  $_SESSION['S_UID'];
    require_once("../../../config.php");

?>
<html>
<head>
	<meta charset="utf-8">
	<title>动态列表</title>
</head>
<link rel="stylesheet" type="text/css" href="../../src/AmazeUI-2.7.2/assets/css/amazeui.css">
<link rel="stylesheet" type="text/css" href="../../src/AmazeUI-2.7.2/assets/css/admin.css">
<link rel="stylesheet" type="text/css" href="../../src/css/ls.css">
<style type="text/css">
  #ul-page a{
    cursor: pointer;
  }
</style>
<body>
<div class="admin-content" id="g-doc" data-uid="<?php echo $S_UID; ?>" data-username="<?php echo $S_USRENAME; ?>">
    <div class="admin-content-body">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf">
          <strong class="am-text-primary am-text-lg">
            阑山动态
          </strong>
          /
          <small>
          动态列表
          </small>
        </div>
      </div>
      <div class="am-g">
        <div class="am-u-sm-12">
          <table class="am-table am-table-bd am-table-striped admin-content-table">
            <thead>
              <tr>
                <th>
                  ID
                </th>
                <th>
                  标题
                </th>
                <th>
                图片
                </th>
                <th>
                时间
                </th>
                <th>
                  编辑
                </th>
              </tr>
            </thead>
            <tbody>
              <tr  v-for="(item,index) in dynamicList">
                <td>
                {{item.id}}
                </td>
                <td>
                {{item.title}}
                </td>
                <td>
                  <img width="36px;" height="36px;"  v-bind:src="item.img | imgUrl(item.uid)">
                </td>
                <td>
                  <span class="am-badge am-badge-success">
                  {{item.dTime}}
                  </span>
                </td>
                <td>
                  <button type="button" class="am-btn am-btn-success" v-on:click="dynamicUpdate(item.id,index)">修改</button>
                  <button type="button" class="am-btn am-btn-danger"  v-on:click="dynamicDelete(item.id,index)">删除</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <ul class="am-pagination" id="ul-page" >
<!--       <li class="am-disabled" v-if="pageData.button.length>0">
          <a>上一页</a>
      </li>
      <li v-for="(item,index) in pageData.button" >
         <a  v-bind:data-key="index">{{item.text}}</a>
      </li>
      <li v-if="pageData.button.length>0">
        <a>下一页</a>
      </li> -->
    </ul>

    <vue-nav :cur="curPage" :all="allPage" :callback="dynamicPagingChange"></vue-nav>

    
    <!-- modal task start -->
    <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
      <div class="am-modal-dialog">
        <div class="am-modal-hd">
         阑山动态
        </div>
        <div class="am-modal-bd">
          你，确定要删除这条记录吗？
        </div>
        <div class="am-modal-footer">
          <span class="am-modal-btn" data-am-modal-cancel>
            取消
          </span>
          <span class="am-modal-btn" data-am-modal-confirm>
            确定
          </span>
        </div>
      </div>
    </div>
    <!-- modal task end -->
</body>
<script type="text/javascript" src="../../src/js/util.js"></script>

<script type="text/javascript" src="../../src/js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="../../src/js/vue.js"></script>
<script type="text/javascript" src="../../src/js/vue-page.js"></script>
<!--<![endif]-->
<script type="text/javascript"  src="../../src/AmazeUI-2.7.2/assets/js/amazeui.js"></script>
<script type="text/javascript" src="../../src/js/dynamic-list.js"></script>
<?php 
	if(!$S_USRENAME&&!$S_UID){
?>
  <script type="text/javascript">
    console.log("缓存失效")
    ModalLoading({
      title:"检测到你未登陆，正在退出",
      show:true
    });
    setTimeout(() => {
      window.location.href="../../login.php";
    }, 2000);
	</script>	
<?php
  }
?>
</html>