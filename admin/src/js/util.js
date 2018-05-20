function ModalLoading(obj){
    var title=obj.title||"";
    var templete=`<div class="am-modal am-modal-loading" id="my-modal-loading">
        <div class="am-modal-dialog">
        <div class="am-modal-hd">${title}</div>
        <div class="am-modal-bd">
            <span class="am-icon-spinner am-icon-spin"></span>
        </div>
        </div>
    </div>`;
  
    try{
        obj.show=obj.show||true;
        if(obj.show){
            $("body").append(templete);
        }
        else{
            $("body").remove("#my-modal-loading");
        }

        $("#my-modal-loading").show();
        $("#my-modal-loading").css("opacity","1"); //设置透明度
    }
    catch(e){
        console.log("ModalLoading e=>",e);
    }
}

