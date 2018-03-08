<div id="talk" style="width: 300px; height: 300px;overflow-y: auto">

</div>
<input type="hidden" id="fromUid" value="{!! $uid !!}">
<input type="hidden" id="toUid" value="5">

<script>
var fromUid = document.getElementById('fromUid').value;
    var Socket = new WebSocket("ws://127.0.0.1:9501?fromUid=" + fromUid);
    Socket.onopen = function (event) {
		console.log('成功连接IM服务器');
    };
    Socket.onmessage = function (event) {


        var newObj = document.createElement('p');
        newObj.innerText = event.data;

        document.getElementById("talk").appendChild(newObj);
    }
</script>

<select id="user">
    <option></option>
</select>
<input  type="text" id="content">
<button  onclick="sendMsg()">发送</button>

<script>
    var  sendMsg = function(){

        var fromUid = document.getElementById('fromUid').value;
        var toUid = document.getElementById('toUid').value;
        var content = document.getElementById('content').value;
        var data = {
            "fromUid" : fromUid,
            "toUid" : toUid,
            "content" : content
        };
        Socket.send(JSON.stringify(data));

        document.getElementById('content').value = "";
    }

</script>

