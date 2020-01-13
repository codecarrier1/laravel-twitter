 
@extends('layouts.app')

@section('content')
 
<div class="con1tainer">
    
</div>
<script src="//cdn.socket.io/socket.io-1.2.0.js" type="text/javascript"></script>
  <script>
   
    
    var id;
    var country;
   
   var spammers;
    var profile;
    function display_post(post)
    {
        
        $("#rule").fadeIn("slow");
        data =post;
        console.log(post);
        var row;
        var row1;
        var pos = data["text"].indexOf(profile["keyword1"]);
        var pos1 = data["text"].indexOf(profile["keyword2"]);
        if((pos!=-1) ||(pos1!=-1))
            row = $("<tr style='background-color:#af5656'></tr>");
        else
            row = $("<tr></tr>");
        row1 = $("<tr></tr>");
        col1 = $("<td>"+data["user"]["name"]+"</td>");
        col2 = $("<td>"+data["text"]+"</td>");
        col3 = $("<td>"+data["user"]["name"]+"</td>");
        col4 = $("<td>"+data["text"]+"</td>"); 
        if((pos!=-1) ||(pos1!=-1))
        {
           
            row1.append(col1,col2).prependTo("#tbl_spammer");
            row.append(col3,col4).prependTo("#tbl_post");  
        }
        else
            row.append(col1,col2).prependTo("#tbl_post")
       row_count =  $('#tbl_post').find('tr').length; 
       if(row_count==100)
          document.getElementById("tbl_post").deleteRow(99);
    }
    var started = false;
    var socket;
     socket = io.connect('https://stream.puretag.net:8443/');
    function time_detect()
    {
        if(started)
        {
        socket.emit("stop");
  
        socket.emit('change', {id: id});
         socket.emit('start', {id: id});
        setTimeout(time_detect,60000);
        }
    }
    function detect()
    {
         started = !started
       country = $("#input_country").val();
        for(var i = 0; i < data.length; i ++)
            if(data[i]["country"] == country)
            {
                id = data[i]["parentid"];
                break;
            }
       
        if(started)
        {
              $.ajax({
               type:'GET',
               url:'/detect',
               data:'country='+country+"&id="+id,
               success:function(response) 
               {
               
                   profile = response["profiles"];
                   console.log(profile);
                   if(profile==null)
                   {
                       $("#rule").html("There is no Profile");
                     return;
                   }
                    spammers = response["spammers"];
                   for(var i =0 ; i < spammers.length; i ++){
                       var html = "<tr><td>"+spammers[i]["name"]+"</td><td>"+spammers[i]["post"]+"</td><td>"+spammers[i]["state"]+"</td></tr>";
                       $("#tbl_spammer").append(html);
                   }
                   $("#priority").html(profile["priority"]);
                   $("#keyword1").html(profile["keyword1"]);
                   $("#keyword2").html(profile["keyword2"]);
                  console.log(profile); 
                  $("#process").attr("src","/public/process.gif");
                 $("#start").text("Stop detecting");
                 
                 
                  console.log('connecting ...');
                socket.emit('start', {id: id});
                socket.emit('change', {id: id});
                setTimeout(time_detect,60000);
                socket.on('hashtags', function (data) {
                 console.log(data);
                $("#hashtags").html(data["hashtags"]);
                
              });

            socket.on('newTweet', function (data) {
                console.log(data);
                display_post(data);
                
              });
            
              console.log(id);
               
                   
               }
               
            });
     
           
        }
        else
        {
            socket.emit('stop');
            $("#process").attr("src","");
            $("#start").text("Start detecting");
              return;
        }
         
    }
</script>

@endsection
