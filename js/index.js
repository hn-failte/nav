//解决IE8之类不支持getElementsByClassName
if (!document.getElementsByClassName) {
    document.getElementsByClassName = function (className, element) {
        var children = (element || document).getElementsByTagName('*');
        var elements = new Array();
        for (var i = 0; i < children.length; i++) {
            var child = children[i];
            var classNames = child.className.split(' ');
            for (var j = 0; j < classNames.length; j++) {
                if (classNames[j] == className) {
                    elements.push(child);
                    break;
                }
            }
        }
        return elements;
    };
}

//时间模块
var time=document.getElementsByClassName("realtime")[0];
setInterval(function(){
	var h=0,m=0,s=0;
	var da=new Date();
	var str="";
	h=da.getHours();
	m=da.getMinutes();
	s=da.getSeconds();
	if(h<10 && h>=0) {str="0"+h+":";}
	else {str+=""+h+":";}
	if(m>=0 && m<10) {str+="0"+m+":";}
	else {str+=""+m+":";}
	if(s>=0 && s<10){str+="0"+s;}
	else {str+=""+s+"";}
	time.innerHTML=str;
}, 1000);

//搜索模块
var search_engine=1; //搜索引擎控制变量
var search_logo=document.getElementsByClassName("search-logo")[0];
var search_input=document.getElementsByClassName("search-input")[0];
var search_btn=document.getElementsByClassName("search-btn")[0];
var ul=document.getElementsByTagName("ul")[0];
var lis=null;
var lis_state=0;
search_input.onkeyup=function(event){
	var event=event || window.event;
	if(event.keyCode==13) search_btn.click();
	if(search_input.value=="") ul.style.display="none";
	else ul.style.display="block";
	switch(search_engine){
		case 1:
			var script = document.createElement("script");
			script.src="https://www.baidu.com/su?wd="+search_input.value+"&cb=showInfo";
			document.body.appendChild(script);
			document.body.removeChild(script);
			break;
		case 2:
			var script = document.createElement("script");
			script.src = "https://www.sogou.com/suggnew/ajajjson?key="+search_input.value+"&type=web";
			document.body.appendChild(script);
			document.body.removeChild(script);
			break;
		case 3:
			//https://www.google.com/complete/search?q=d&cp=1&client=psy-ab
			break;
	}
};
var sogou = new Object();
sogou.sug=function(json){
	var arr = json.s;
	var i=0;
	ul.innerHTML="";
	var li;
	for(var item of json[1]){
		li=document.createElement("li");
		li.innerHTML = "<a href='https://www.baidu.com/s?wd=" + item + "'>" + item + "</a>";
		ul.appendChild(li);
	}
}
function showInfo(json){
	var arr = json.s;
	var i=0;
	ul.innerHTML="";
	var li;
	for(var item of arr){
		li=document.createElement("li");
		li.innerHTML = "<a href='https://www.baidu.com/s?wd=" + item + "'>" + item + "</a>";
		ul.appendChild(li);
	}
}
function searchGo(){
	var search_content;
	switch(search_engine){
		case 1:
			search_content="https://www.baidu.com/s?wd="+search_input.value;
			break;
		case 2:
			search_content="https://www.sogou.com/web?query="+search_input.value;
			break;
		case 3:
			search_content="https://www.google.com/search?q="+search_input.value;
			break;
	}
	window.location.href=search_content;
}
function engineChoose(){
	switch(search_engine) {
		case 3:
			search_logo.innerHTML="&#xe65e;";
			search_logo.style.color="#052bff";
			search_engine=1;
			break;
		case 1:
			search_logo.innerHTML="&#xe628;";
			search_logo.style.color="#ff7e22";
			search_engine++;
			break;
		case 2:
			search_logo.innerHTML="&#xe622;";
			search_logo.style.color="#4285f4";
			search_engine++;
			break;
	}
}

//链接模块
//ajax
window.onload=function() {
	var xhr = XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHttp");
	xhr.onreadystatechange=function(){
		if(this.readyState==4 && this.status==200){
			var links=JSON.parse(this.responseText);
			initTable(links);
		}
	}
	var date=new Date().getTime();
	xhr.open("get","php/ajax.php?_="+date,true);
	xhr.send(null);
}

//read json file to create link
function initTable(links) {
	var table = document.getElementsByTagName("table")[0];
	table.innerHTML="";
	var tr;
	for(var item in links){
		if(item%5==0){
			tr = document.createElement("tr");
			table.appendChild(tr);
		}
		td="<td><a href="+links[item].link_value+">"+links[item].link_name+"</a></td>";
		tr.innerHTML+=td;
		if(item==links.length-1) tr.innerHTML+="<td><a href='javascript: void(0);' onclick='return false'>Add</a></td>";
	}
}