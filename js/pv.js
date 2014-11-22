(function(){
    var path = 'action/pv.php';

    var getXmlHttpObj=function() {
    try{
        xmlHttp = new XMLHttpRequest();
    }catch (e){
        try{
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }catch (e){
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
        return xmlHttp;
    }

    var post=function(url){

    var xmlHttp=getXmlHttpObj();
    if(!xmlHttp){
        return false;
    }

    xmlHttp.open("POST",url,true);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4 && xmlHttp.status==200){
            setcookie('lasttime',time);
            console.log('foxsaysnice');
            }
        }
    }

    xmlHttp.send();
}

    function setCookie(key,value){
        var Days = 0.1;
        var exp = new Date(); //new Date("December 31, 9998");
        exp.setTime(exp.getTime() + Days*24*60*60*1000);
        document.cookie = key + "="+ escape(value) + ";expires=" + exp.toGMTString();
    }

    function getCookie(key){
        var arr = document.cookie.match(new RegExp("(^| )"+key+"=([^;]*)(;|$)"));
        if(arr != null) return unescape(arr[2]); return null;
    }

    function delCookie(key){
        var exp = new Date();
        exp.setTime(exp.getTime()-1000);
        var cval=getCookie(key);
        if(cval!=null) document.cookie= key + "="+cval+";expires="+exp.toGMTString();
    }

    if(navigator.cookieEnabled){
        var obj_time = new Date();
        var h=obj_time.getHours();
        var m=obj_time.getMinutes();
        var time=h*60+m;
        setcookie('nowtime',time);

        if(getcookie('lasttime')==null){
            setcookie('lasttime',time);
        }else{
            var lasttime = getcookie('lasttime');
            if(time - lasttime>1){
                post(path);
            }else{
                setcookie('lasttime',time);
            }
        }
    }else{
        post(path);
    }
})()


