const doc = new Vue({
    el: '.g-doc',
    data: {
        username:"",
        password:"",
      msg: '请输入账号密码登陆'
    },
    methods:{
        init:function(){
            var self=this;
            self.userLogin();
        },
        userLogin:function(){
            var self=this;
            var myform=document.forms["myform"],  //表单
              username=myform.elements["username"],	//账号
              password=myform.elements["password"];	//密码
              function postData(e){
                  self.msg="正在登录中...";
                  var url="./libs/control/c-login-form.php";
                  var params={
                      username:username.value,
                      password:password.value
                  }
                  $.get({
                    url: url,
                    data: params,
                    success: function(res){
                        console.log("登陆请求 res=>",res)
                        self.msg=res.msg;
                        if(res.status==200){
                            window.location.href="./index.php";
                        }
                    },
                    dataType: "json"
                  });
              }
  
              myform.addEventListener("submit",function(e){
                  e=e||window.event;  
                  // 阻止默认事件
                  if (e.preventDefault)
                  {  
                      e.preventDefault(); 
                  }
                  else
                  {  
                      e.returnValue = false; 
                  }
                  postData(e)
              });
        }
    }
  });
  doc.init();