@extends('layouts.app')
<style type="text/css">
        .message-wrap
        {
        box-shadow: 0 0 3px #ddd;
        padding: 0;
        }
        .msg
        {
        padding:5px;
        /*border-bottom:1px solid #ddd;*/
        margin:0;
        }
        .msg-wrap
        {
        padding:10px;
        max-height: 80%;
        overflow: auto;
        }
        .time
        {
        color:#bfbfbf;
        }
        .msg-wrap .media-heading
        {
        color:#003bb3;
        font-weight: 700;
        }
        body::-webkit-scrollbar {
        width: 12px;
        }
        ::-webkit-scrollbar {
        width: 6px;
        }
        ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        /* -webkit-border-radius: 10px;
        border-radius: 10px;*/
        }
        ::-webkit-scrollbar-thumb {
        /* -webkit-border-radius: 10px;
        border-radius: 10px;*/
        background:#ddd;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
        }
        ::-webkit-scrollbar-thumb:window-inactive {
        background: #ddd;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var socket;
            if (!window.WebSocket) {
                window.WebSocket = window.MozWebSocket;
            }
            if (window.WebSocket) {
				console.log(location.hostname);
                var socketAddress = location.hostname + (location.port ? ':' + location.port : '');
                var nextID = 0;
                var messageCount = 0;
                socket = new WebSocket("ws://" + socketAddress + "/websocket");
                socket.onmessage = function(event) {
                    if(messageCount > 20){
                        $("#msg" + (nextID - 21)).remove();
                        messageCount--;
                    }
                    var data = event.data.split(":");
                    var username = escapeHtml(data[0]);
                    var message = escapeHtml(event.data.substring(event.data.indexOf(":") + 1, event.data.length));
                    writeHTML('<div class="media msg" id="msg' + nextID + '"><a class="pull-left"><img class="media-object" alt="' + username + '" title="' + username + '" style="width: 32px; height: 32px;" src="https://minotar.net/avatar/' + username + '/32.png"></a><div class="media body"><small class="pull-right time"><i class="fa fa-clock-o"></i>&nbsp;' + formatAMPM(new Date()) + '</small><h5 class="media-heading">' + username + '</h5><small class="col-lg-10">' + message + '</small></div></div>');
                    nextID++;
                    messageCount++;
                };
                socket.onopen = function(event) {
                    writeHTML("<b>Connected to the server.</b>");
                };
                socket.onclose = function(event) {
                    writeHTML("<b>Lost connection to the server.</b>");
                };
            } else {
                alert("Your browser does not support Web Sockets.");
            }
        });
        function writeHTML(content){
            var messageContent = $("#messages");
            messageContent.append(content);
            $("html, body").animate({ scrollTop: $(document).height() }, "slow");
        }
        var entityMap = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': '&quot;',
            "'": '&#39;',
            "/": '&#x2F;'
        };
        function escapeHtml(string) {
            return String(string).replace(/[&<>"'\/]/g, function (s) {
                return entityMap[s];
            });
        }
        function formatAMPM(date) {
          var hours = date.getHours();
          var minutes = date.getMinutes();
          var ampm = hours >= 12 ? 'pm' : 'am';
          hours = hours % 12;
          hours = hours ? hours : 12; // the hour '0' should be '12'
          minutes = minutes < 10 ? '0'+minutes : minutes;
          var strTime = hours + ':' + minutes + ' ' + ampm;
          return strTime;
        }
    </script>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <iframe id="chat" src="http://serverip:8080/"></iframe>  
        </div>
    </div>
</div>
@endsection
