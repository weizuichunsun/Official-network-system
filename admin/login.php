<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>澜山登陆</title>
</head>
<link rel="stylesheet" type="text/css" href="./src/AmazeUI-2.7.2/assets/css/amazeui.css">
<link rel="stylesheet" type="text/css" href="./src/css/ls.css">
	<style type="text/css">
		.u-msg{
			color: #e56c0c;
		}
	</style>
<body>
<div class="g-doc">
	<div class="m-login">
		<form class="am-form"  method="get" name="myform">
		  <fieldset>
		    <legend>登陆</legend>

		    <div class="am-form-group">
		      <label for="doc-ipt-username">账号</label>
		      <input type="text" name="username" class="" id="doc-ipt-username" placeholder="输入账号">
		    </div>

		    <div class="am-form-group">
		      <label for="doc-ipt-pwd">密码</label>
		      <input type="password" name="password" class="" id="doc-ipt-pwd" placeholder="输入密码">
		    </div>
		    <p class="u-msg">{{msg}}</p>
		    <p><button type="submit" class="am-btn am-btn-primary">登陆</button></p>
		  </fieldset>
		</form>
	</div>	
</div>
</body>
<script type="text/javascript" src="./src/js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="./src/js/vue.js"></script>
<script type="text/javascript" src="./src/js/login.js"></script>
</html>