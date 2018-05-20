// var Vnav =require("./vue-page.js");
var doc = new Vue({
	el: '#g-doc',
	data: {
		message: 'Hello Vue!',
		uid:document.getElementById("g-doc").dataset.uid,
		username:document.getElementById("g-doc").dataset.username,
		curPage: 1,
        allPage: 1,
        pageSize :1,
        msg: '',
		dynamicList: [
			{
				id: "",
				title: "",
				describe: "",
				content: "",
				img: "",
				times: ""
			}
		]
	},
	 components:{
        'vue-nav': Vnav
      },
	methods: {
		dynamicPagingChange(data) {
          this.curPage = data;
          console.log("this.curPage =>",data)
          // this.msg = '你点击了'+data+ '页';
          this.dynamicGet(data);
        },
        dynamicPaging(res) {
          // this.cur = data
          // this.msg = '你点击了'+data+ '页';
        
          this.allPage = Math.ceil(res.count / this.pageSize);
        },
		init: function() {
            var self = this;
			console.log("list")
            self.dynamicGet();
            // self.dynamicPaging();
		},
		/**
			分页
		*/
		dynamicUpdate: function(id,index){
			var self = this;
			var url = "dynamic-update.php?id="+id;
			console.log("liUpdate function id=>",id,url);
			window.location.href=url;

		},
		dynamicDelete: function(id,index){
			var self = this;
			console.log("dynamicDelete function id,index=>",id,index);
			var ret=(function(){
				// console.log("am modal onConfirm callback id,index=>",id,index);
				// #备用方案！
				var id=$('#my-confirm')[0].dataset.id;
				var index=$('#my-confirm')[0].dataset.index;

				var url = "../control/c-dynamic-delete.php";
				var parameter = {
					id:id
				}
				$.post({
					url: url,
					data: parameter,
					success: function(res){
						console.log("获取动态列表 res=>",res)
						if(res.rstId>0){
							self.dynamicList.splice(index,1);
							if(self.allPage>0){
								self.allPage = self.allPage-1;
							}
							// location.reload();
							
						}
					},
					error:function(err){
						console.log("err=>",err)
					},
					dataType: "json"
				});

			});

			// #备用方案！
			$('#my-confirm')[0].setAttribute("data-id",id);
			$('#my-confirm')[0].setAttribute("data-index",index);

			$('#my-confirm').modal({
				relatedTarget: this,
				onConfirm: function(options) {
					ret();
				},
				onCancel: function() {
					console.log("am onCancel");
				}
			});
		},
		dynamicGet:function(page){
			var self = this;
			var url = "../control/c-dynamic-list.php";
			var parameter = {
				uid: self.uid,
				page:page||1,
				pageSize:self.pageSize
			}
			$.get({
				url: url,
				data: parameter,
				success: function(res){
					console.log("获取动态列表 res=>",res)
					if(res.rstId>0&&res.data){
						self.dynamicPaging(res);
						self.dynamicList = res.data;
					}
				
				},
				error:function(err){
					console.log("err=>",err)
				},
				dataType: "json"
			});
		}
	},
	filters: {
		imgUrl: function(value,uid){
			// console.log(value,uid)
			if (!value) return '';
			value="../../../source/img/"+uid+"/"+value;
			return value;
		}
	}
});
doc.init();