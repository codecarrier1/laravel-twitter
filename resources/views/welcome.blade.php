<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//cdn.socket.io/socket.io-1.2.0.js" type="text/javascript"></script>
   <script  src="http://code.jquery.com/jquery.min.js"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            
               .btn-style {
          display: inline-block;
          border-radius: 4px;
          background-color: #99f;
          border: none;
          color: #FFFFFF;
          text-align: center;
          font-size: 16px;
          padding: 10px;
          width:200px;
          transition: all 0.5s;
          cursor: pointer;
          margin: 5px;
        }
        
        .btn-style span {
          cursor: pointer;
          display: inline-block;
          position: relative;
          transition: 0.5s;
        }
        
        .btn-style span:after {
          content: '\00bb';
          position: absolute;
          opacity: 0;
          top: 0;
          right: -20px;
          transition: 0.5s;
        }
        
        .btn-style:hover span {
          padding-right: 25px;
        }
        
        .btn-style:hover span:after {
          opacity: 1;
          right: 0;
        }
                   
        </style>
    </head>
    <body>
        <div id="content"></div>
       
        <div style="text-align: right">
            <a href="{{ url('/auth/admin') }}" style="margin-right: 30px">admin</a>
        </div>
        <div class="flex-center position-ref full-height">
           <div style="text-align:center">
           <h3 class="text-center">Welcome to visit our homepage.</h3> 
            <div>If you login to your homepage, you can remove the spammers easily in Twitter</div>
             <a href="{{ url('auth/redirect/twitter') }}">
                 <button class="btn-style"><span>Twitter Login</span></button></a>
                  
            </div>
        </div>
     <script type="text/javascript">
   
  </script>
    </body>
</html>
